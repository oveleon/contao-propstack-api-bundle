<?php

namespace Oveleon\ContaoPropstackApiBundle\Security\Api;

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\StringUtil;
use Oveleon\ContaoPropstackApiBundle\Model\PropstackAuthModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class Authenticator
{
    private Request $request;

    private ?PropstackAuthModel $model = null;
    private ?string $key;

    public function __construct(ContaoFramework $framework, RequestStack $requestStack)
    {
        // Initialize contao framework
        $framework->initialize();

        // Get current request
        $this->request = $requestStack->getCurrentRequest();

        // Check if a key exists
        if($this->key = $this->request->get('key'))
        {
            // Check if key exists and set model
            if(null !== ($model = PropstackAuthModel::findOneByKey($this->key)))
            {
                $this->model = $model;
            }
        }
    }

    public function isGranted(): bool
    {
        if($this->key && $this->model)
        {
            if($this->model->restrictIp && $this->model->restrictHost)
            {
                return $this->checkIp() && $this->checkHost();
            }

            if($this->model->restrictIp)
            {
                return $this->checkIp();
            }

            if($this->model->restrictHost)
            {
                return $this->checkHost();
            }

            return true;
        }

        return false;
    }

    private function checkIp(): bool
    {
        // Get trusted proxies
        $trustedProxies = StringUtil::deserialize($this->model->allowedIps, true);

        // Set trusted headers
        $trustedHeaderSet =
            Request::HEADER_X_FORWARDED_FOR |
            Request::HEADER_X_FORWARDED_PORT |
            Request::HEADER_X_FORWARDED_PROTO;

        Request::setTrustedProxies($trustedProxies, $trustedHeaderSet);

        // Check if ip is trusted
        if(in_array($this->request->getClientIp(), $trustedProxies))
        {
            return true;
        }

        return false;
    }

    private function checkHost(): bool
    {
        // Get trusted hosts
        $trustedHosts = StringUtil::deserialize($this->model->allowedHosts, true);
        $trustedHosts = array_map(fn($host) => parse_url($host, PHP_URL_HOST), $trustedHosts);

        // Check host ip is trusted
        if(in_array($this->request->getHost(), $trustedHosts))
        {
            return true;
        }

        return false;
    }
}
