<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class SearchInquiryOptions extends Options
{
    protected function configure(): void
    {
        $this->set(Options::MODE_READ, [
            'client'
        ]);

        $this->set(Options::MODE_CREATE, $this->getFields());
        $this->set(Options::MODE_EDIT, $this->getFields());
    }

    public function getFields(): array
    {
        return [
            'client_id',
            'active',
            'cities',
            'regions',
            'marketing_type',
            'rs_types',
            'rs_categories',
            'group_ids',
            'note',

            'living_space',
            'living_space_to',
            'price',
            'price_to',
            'number_of_rooms',
            'number_of_rooms_to',
            'number_of_bedrooms',
            'number_of_bedrooms_to',
            'base_rent',
            'base_rent_to',
            'floor',
            'floor_to',
            'plot_area',
            'plot_area_to',
            'construction_year',
            'construction_year_to',
            'lift',
            'balcony',
            'garden',
            'built_in_kitchen',
            'cellar',
            'rented'
        ];
    }
}
