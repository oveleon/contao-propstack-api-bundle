<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class CustomFieldOptions extends Options
{
    protected function configure(): void
    {
        $this->set(Options::MODE_READ, [
            'entity'
        ]);
    }
}
