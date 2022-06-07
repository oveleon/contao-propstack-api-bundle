<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class UnitImageOptions extends Options
{


    protected function configure(): void
    {
        $this->set(Options::MODE_CREATE, [
            'photo',
            'imageable_id',
            'imageable_type',
            'is_privat',
            'title'
        ]);
    }
}
