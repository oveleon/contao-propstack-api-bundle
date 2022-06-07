<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class NoteOptions extends Options
{
    protected function configure(): void
    {
        $this->set(Options::MODE_READ, [
            'tag',
            'broker',
            'note_type',
            'client',
            'property',
            'project'
        ]);
    }
}
