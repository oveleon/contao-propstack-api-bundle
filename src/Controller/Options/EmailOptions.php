<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class EmailOptions extends Options
{
    protected function configure(): void
    {
        $this->set(Options::MODE_CREATE, [
            'broker_id',
            'snippet_id',
            'cc',
            'to',

            'message_attachment_ids',
        ]);
    }
}
