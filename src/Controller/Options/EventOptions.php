<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class EventOptions extends Options
{
    protected function configure(): void
    {
        $this->set(Options::MODE_READ, [
            'recurring',
            'ends_at_after',
            'ends_at_before',
            'starts_at_after',
            'starts_at_before',
            'tag',
            'broker',
            'note_type',
            'state',
            'client',
            'property',
            'project'
        ]);
    }
}
