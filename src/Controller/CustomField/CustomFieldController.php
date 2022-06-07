<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\CustomField;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\CustomFieldOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle custom field calls
 *
 * @link https://docs.propstack.de/reference/custom-felder
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class CustomFieldController extends PropstackController
{
    protected string $route = 'custom_field_groups';

    /**
     * Read custom fields
     */
    public function read(array $parameters)
    {
        $this->call(
            (new CustomFieldOptions(Options::MODE_READ))
                ->validate($parameters),
            self::METHOD_READ
        );

        return $this->getResponse();
    }
}
