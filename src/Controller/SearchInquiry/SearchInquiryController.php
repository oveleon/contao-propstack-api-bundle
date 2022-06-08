<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\SearchInquiry;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\SearchInquiryOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle search inquiry calls
 *
 * @link https://docs.propstack.de/reference/suchprofile
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class SearchInquiryController extends PropstackController
{
    protected string $route = 'saved_queries';

    /**
     * Read search inquiries
     */
    public function read(array $parameters)
    {
        $this->call(
            (new SearchInquiryOptions(Options::MODE_READ))
                ->validate($parameters),
            self::METHOD_READ
        );

        return $this->getResponse();
    }

    /**
     * Create search inquiry
     */
    public function create(array $parameters)
    {
        $this->call(
            (new SearchInquiryOptions(Options::MODE_CREATE))
                ->validate($parameters),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }

    /**
     * Edit search inquiry
     */
    public function edit($id, array $parameters)
    {
        // Add id to route
        $this->addRoutePath($id);

        $this->call(
            (new SearchInquiryOptions(Options::MODE_EDIT))
                ->validate($parameters),
            self::METHOD_EDIT
        );

        return $this->getResponse();
    }

    /**
     * Delete search inquiry
     */
    public function delete($id)
    {
        // Add id to route
        $this->addRoutePath($id);

        $this->call([], self::METHOD_DELETE);

        return $this->getResponse();
    }
}
