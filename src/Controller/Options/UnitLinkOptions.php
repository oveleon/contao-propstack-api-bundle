<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class UnitLinkOptions extends Options
{
    protected function configure(): void
    {
        $this->set(Options::MODE_CREATE, [
            'is_embedable',
            'on_landing_page',
            'is_private',
            'title',
            'url',
            'property_id'
        ]);

        $this->set(Options::MODE_EDIT, [
            'is_embedable',
            'on_landing_page',
            'is_private',
            'title',
            'url',
            'property_id'
        ]);
    }
}
