<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class ActivityOptions extends Options
{
    protected function configure(): void
    {
        $this->set(Options::MODE_READ, [
            'page',
            'per',
            'category_id',
            'client_id',
            'property_id',
            'project_id',
            'item_type',
            'broker_id'
        ]);
    }
}
