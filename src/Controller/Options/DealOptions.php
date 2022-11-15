<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class DealOptions extends Options
{
    protected function configure(): void
    {
        $this->set(Options::MODE_READ, $this->getCreateEditFields());
        $this->set(Options::MODE_EDIT, $this->getCreateEditFields());
        $this->set(Options::MODE_CREATE, [
            'client_property'
        ]);
    }

    public function getCreateEditFields(): array
    {
        return [
            'include',
            'reservation_reason_ids',
            'category',
            'deal_stage_ids',
            'deal_pipeline_id',
            'project_id',
            'broker_id',
            'client_id',
            'property_id'
        ];
    }
}
