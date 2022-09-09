<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class EmailOptions extends Options
{
    protected function configure(): void
    {
        $this->set(Options::MODE_CREATE, [
            'message' => [
                'broker_id',
                'snippet_id',
                'subject',
                'body',
                'from',
                'to',
                'cc',
                'bcc',
                'client_ids',
                'property_ids',
                'project_ids',
                'message_attachment_ids',
                'client_source_id',
                'message_category_id'
            ]
        ]);
    }
}
