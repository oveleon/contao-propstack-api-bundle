<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class DocumentOptions extends Options
{
    protected function configure(): void
    {
        $this->set(Options::MODE_READ, [
            'page',
            'per',
            'order_by',
            'tag',
            'is_private',
            'client',
            'property',
            'project'
        ]);

        $this->set(Options::MODE_CREATE, $this->getCreateEditFields());
        $this->set(Options::MODE_EDIT, $this->getCreateEditFields());
    }

    public function getCreateEditFields(): array
    {
        return [
            'document' => [
                'tags',
                'on_landing_page',
                'is_floorplan',
                'is_expose',
                'client_id',
                'project_id',
                'property_id',
                'doc',
                'title',
                'is_private'
            ]
        ];
    }
}
