<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class SuperTagOptions extends Options
{
    protected function configure(): void
    {
        $this->set(Options::MODE_READ, [
            'entity',
            'include'
        ]);
    }
}
