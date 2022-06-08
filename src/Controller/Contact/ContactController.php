<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Contact;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\ContactOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle contact calls
 *
 * @link https://docs.propstack.de/reference/kontakte
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class ContactController extends PropstackController
{
    protected string $route = 'contacts';

    /**
     * Read contacts
     */
    public function read(array $parameters)
    {
        $this->call(
            (new ContactOptions(Options::MODE_READ))
                ->validate($parameters),
            self::METHOD_READ
        );

        return $this->getResponse();
    }

    /**
     * Read contact
     */
    public function readOne($id, array $parameters)
    {
        // Add id to route
        $this->addRoutePath($id);

        // The parameter `id` in this case can also be a token string. If this is the case, we have to tell
        // the API that we are working with a token instead of using the classic way via the ID.
        if(!is_numeric($id))
        {
            $parameters['identifier'] = 'token';
        }

        $this->call(
            (new ContactOptions(ContactOptions::MODE_READ_SINGLE))
                ->validate($parameters),
            self::METHOD_READ
        );

        return $this->getResponse();
    }

    /**
     * Edit contact
     */
    public function edit($id, array $parameters)
    {
        // Add id to route
        $this->addRoutePath($id);

        // Create and edit calls need to wrap in a client object
        $parameters = [
            'client' => $parameters
        ];

        // The parameter `id` in this case can also be a token string. If this is the case, we have to tell
        // the API that we are working with a token instead of using the classic way via the ID.
        if(!is_numeric($id))
        {
            $parameters['identifier'] = 'token';
        }

        $this->call(
            (new ContactOptions(Options::MODE_EDIT))
                ->validate($parameters),
            self::METHOD_EDIT
        );

        return $this->getResponse();
    }

    /**
     * Create contact
     */
    public function create(array $parameters)
    {
        $this->call(
            (new ContactOptions(Options::MODE_CREATE))
                ->validate(['client' => $parameters]),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }

    /**
     * Delete contact
     */
    public function delete($id)
    {
        // Add id to route
        $this->addRoutePath($id);

        $this->call([], self::METHOD_DELETE);

        return $this->getResponse();
    }

    /**
     * Set a contact as favorite
     */
    public function favorite($id, array $parameters)
    {
        // Add id and favorites to route
        $this->addRoutePath($id);
        $this->addRoutePath('favorites');

        // The parameter `id` in this case can also be a token string. If this is the case, we have to tell
        // the API that we are working with a token instead of using the classic way via the ID.
        if(!is_numeric($id))
        {
            $parameters['identifier'] = 'token';
        }

        $this->call(
            (new ContactOptions(ContactOptions::MODE_CREATE_FAVORITE))
                ->validate($parameters),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }
}
