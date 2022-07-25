<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class UnitImageOptions extends Options
{
    protected function configure(): void
    {
        $this->set(Options::MODE_CREATE, $this->getCreateEditFields());
        $this->set(Options::MODE_EDIT, $this->getCreateEditFields());
    }

    public function getCreateEditFields(): array
    {
        return [
            'photo',
            'imageable_id',
            'imageable_type',
            'is_private',
            'title',
            'position',
            //ToDo: 'tags' when implemented
        ];
    }
}
