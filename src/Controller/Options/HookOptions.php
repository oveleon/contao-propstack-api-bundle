<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class HookOptions extends Options
{
    protected function configure(): void
    {
        $this->set(Options::MODE_CREATE, [
            'target_url',
            'event'
        ]);
    }
}
