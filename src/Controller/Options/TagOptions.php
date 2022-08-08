<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class TagOptions extends Options
{
    protected function configure(): void
    {
        $this->set(Options::MODE_READ, [
            'super_group',
            'entity'
        ]);

        $this->set(Options::MODE_CREATE, [
            'super_group_id',
            'entity',
            'name',
        ]);
    }
}
