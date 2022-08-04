<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class UnitImageOptions extends Options
{
    const MODE_EDIT_SORT = 1001;

    protected function configure(): void
    {
        $this->set(Options::MODE_CREATE, $this->getCreateEditFields());
        $this->set(Options::MODE_EDIT, $this->getCreateEditFields());

        $this->set(Options::MODE_QUERY, [
            'property_id'
        ]);

        $this->set(self::MODE_EDIT_SORT, [
            'item'
        ]);
    }

    public function getCreateEditFields(): array
    {
        return [
            'photo',
            'imageable_id',
            'imageable_type',
            'is_private',
            'is_floorplan',
            'title',
            'position',
            'tags'
        ];
    }
}
