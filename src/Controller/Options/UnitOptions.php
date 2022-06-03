<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

use Oveleon\ContaoPropstackApiBundle\Exception\ApiInvalidArgumentException;

final class UnitOptions extends Options
{
    protected function configure(): void
    {
        $this->set(Options::MODE_READ, [
            'order',
            'sort_by',
            'status',
            'group',
            'q',
            'country',
            'project_id',
            'marketing_type',
            'rs_type',
            'expand',
            'archived',
            'property_ids'
        ]);

        // Create and edit modes are dynamic, see validate-Methode
    }

    /**
     * Extended validation for dynamic field sets (CREATE, EDIT)
     */
    public function validate(array $param, bool $includeRequestParameter = false): array
    {
        // Perform extra checks only in create oder edit mode
        if(!in_array($this->mode, [self::MODE_CREATE, self::MODE_EDIT]))
        {
            return parent::validate($param, $includeRequestParameter);
        }

        if(!isset($param['property']['rs_type']))
        {
            throw new ApiInvalidArgumentException('For creating or editing properties the parameter `rs_type` is required');
        }

        $specifiedOptions = array_merge(
            $this->getGlobalFields(),
            $this->getAddressFields(),
            $this->getDescriptionFields(),
            $this->getCourtageFields(),
            $this->getConnectionFields()
        );

        switch ($param['property']['rs_type'])
        {
            case Constants::OBJECT_TYPE_APARTMENT:
                $specifiedOptions = array_merge(
                    $specifiedOptions,
                    $this->getApartmentFields(),
                    $this->getEnergyFields()
                );

                break;

            case Constants::OBJECT_TYPE_HOUSE:
                $specifiedOptions = array_merge(
                    $specifiedOptions,
                    $this->getHouseFields(),
                    $this->getEnergyFields()
                );

                break;

            case Constants::OBJECT_TYPE_TRADE_SITE:
                $specifiedOptions = array_merge(
                    $specifiedOptions,
                    $this->getTradeSiteFields(),
                    $this->getEnergyFields()
                );

                break;

            case Constants::OBJECT_TYPE_GARAGE:
                $specifiedOptions = array_merge(
                    $specifiedOptions,
                    $this->getGarageFields()
                );

                break;

            case Constants::OBJECT_TYPE_SHORT_TERM_ACCOMODATION:
                $specifiedOptions = array_merge(
                    $specifiedOptions,
                    $this->getShortTermAccommodationFields(),
                    $this->getEnergyFields()
                );

                break;

            case Constants::OBJECT_TYPE_OFFICE:
                $specifiedOptions = array_merge(
                    $specifiedOptions,
                    $this->getOfficeFields(),
                    $this->getEnergyFields()
                );

                break;

            case Constants::OBJECT_TYPE_GASTRONOMY:
                $specifiedOptions = array_merge(
                    $specifiedOptions,
                    $this->getGastronomyFields(),
                    $this->getEnergyFields()
                );

                break;

            case Constants::OBJECT_TYPE_STORE:
                $specifiedOptions = array_merge(
                    $specifiedOptions,
                    $this->getStoreFields(),
                    $this->getEnergyFields()
                );

                break;

            case Constants::OBJECT_TYPE_INDUSTRY:
                $specifiedOptions = array_merge(
                    $specifiedOptions,
                    $this->getIndustryFields(),
                    $this->getEnergyFields()
                );

                break;

            case Constants::OBJECT_TYPE_SPECIAL_PURPOSE:
                $specifiedOptions = array_merge(
                    $specifiedOptions,
                    $this->getSpecialFields(),
                    $this->getEnergyFields()
                );

                break;

            case Constants::OBJECT_TYPE_INVESTMENT:
                $specifiedOptions = array_merge(
                    $specifiedOptions,
                    $this->getInvestmentFields(),
                    $this->getEnergyFields()
                );

                break;
        }

        // Set new field data
        $this->set($this->mode, ['property' => $specifiedOptions], false);

        return parent::validate($param, $includeRequestParameter);
    }

    /**
     * Return all possible property fields
     */
    public function getAllPropertyFields(): array
    {
        return array_merge(
            $this->getGlobalFields(),
            $this->getAddressFields(),
            $this->getDescriptionFields(),
            $this->getApartmentFields(),
            $this->getHouseFields(),
            $this->getTradeSiteFields(),
            $this->getGarageFields(),
            $this->getShortTermAccommodationFields(),
            $this->getOfficeFields(),
            $this->getGastronomyFields(),
            $this->getStoreFields(),
            $this->getIndustryFields(),
            $this->getSpecialFields(),
            $this->getInvestmentFields(),
            $this->getEnergyFields(),
            $this->getCourtageFields(),
            $this->getConnectionFields()
        );
    }

    /**
     * Return field for all types of properties
     */
    public function getGlobalFields(): array
    {
        return [
            'page',
            'per',
            'marketing_type',
            'object_type',
            'rs_type',
            'broker_id',
            'property_status_id',
            'exposee_id',
            'unit_id',
            'title'
        ];
    }

    /**
     * Return valid address fields
     */
    public function getAddressFields(): array
    {
        return [
            'house_number',
            'zip_code',
            'location_id',
            'city',
            'administrative_area_level_1',
            'country',
            'lat',
            'lng',
            'corridor',
            'plot_number',
            'district',
            'hide_address'
        ];
    }

    /**
     * Return all valid description fields
     */
    public function getDescriptionFields(): array
    {
        return [
            'description_note',
            'location_note',
            'furnishing_note',
            'other_note',
            'long_description_note',
            'long_location_note',
            'long_furnishing_note',
            'long_other_note'
        ];
    }

    /**
     * Return all valid description fields
     */
    public function getApartmentFields(): array
    {
        return [
            'base_rent',
            'price',
            'price_on_inquiry',
            'apartment_type',
            'number_of_rooms',
            'living_space',
            'cubature',
            'floor',
            'number_of_floors',
            'floor_position',
            'usable_floor_space',
            'number_of_bed_rooms',
            'number_of_bath_rooms',
            'number_of_parking_spaces',
            'parking_space_price',
            'parking_space_type',
            'service_charge',
            'heating_costs',
            'heating_costs_in_service_charge',
            'condition',
            'last_refurbishment',
            'interior_quality',
            'free_from',
            'pets_allowed',
            'certificate_of_eligibility_needed',
            'rent_subsidy',
            'maintenance_reserve',
            'rental_income',
            'base_rent',
            'total_rent',
            'rented',
            'lan_cables',
            'plot_area',
            'number_of_balconies',
            'number_of_terraces',
            'balcony_space',
            'lift',
            'barrier_free',
            'cellar',
            'guest_toilet',
            'built_in_kitchen',
            'balcony',
            'garden',
            'flat_share_suitable',
            'monument',
            'summer_residence_practical'
        ];
    }

    /**
     * Return all valid house fields
     */
    public function getHouseFields(): array
    {
        return [
            'base_rent',
            'price',
            'price_on_inquiry',
            'building_type',
            'number_of_rooms',
            'living_space',
            'plot_area',
            'cubature',
            'number_of_floors',
            'floor_position',
            'number_of_parking_spaces',
            'parking_space_price',
            'parking_space_type',
            'usable_floor_space',
            'number_of_bed_rooms',
            'number_of_bath_rooms',
            'total_rent',
            'service_charge',
            'heating_costs',
            'heating_costs_in_service_charge',
            'condition',
            'last_refurbishment',
            'interior_quality',
            'free_from',
            'pets_allowed',
            'construction_phase',
            'rental_income',
            'rented',
            'number_of_balconies',
            'number_of_terraces',
            'balcony_space',
            'barrier_free',
            'cellar',
            'guest_toilet',
            'built_in_kitchen',
            'balcony',
            'flat_share_suitable',
            'lodger_flat',
            'monument',
            'summer_residence_practical'
        ];
    }

    /**
     * Return all valid trade site / plot fields
     */
    public function getTradeSiteFields(): array
    {
        return [
            'plot_area',
            'tenancy',
            'price',
            'base_rent',
            'price_on_inquiry',
            'short_term_constructible',
            'commercialization_type',
            'utilization_trade_site',
            'recommended_use_types',
            'site_development_type',
            'site_constructible_type',
            'min_divisible',
            'grz',
            'gfz',
            'bmz',
            'building_permission',
            'preliminary_enquiry',
            'demolition'
        ];
    }

    /**
     * Return all valid garage fields
     */
    public function getGarageFields(): array
    {
        return [
            'base_rent',
            'price',
            'garage_type',
            'construction_year',
            'floor',
            'condition',
            'last_refurbishment',
            'length_garage',
            'width_garage',
            'height_garage',
            'usable_floor_space',
            'free_from',
            'free_until'
        ];
    }

    /**
     * Return all valid short term accommodation fields
     */
    public function getShortTermAccommodationFields(): array
    {
        return [
            'short_term_accomodation_type',
            'number_of_rooms',
            'total_rent',
            'price_interval_type',
            'start_rental_date',
            'end_rental_date',
            'min_rental_time',
            'max_rental_time',
            'max_number_of_persons',
            'living_space',
            'floor',
            'number_of_floors',
            'base_rent',
            'service_charge',
            'has_furniture',
            'number_of_parking_spaces',
            'parking_space_price',
            'parking_space_type',
            'non_smoker',
            'gender',
            'pets_allowed',
            'condition',
            'lift',
            'barrier_free',
            'cellar',
            'guest_toilet',
            'balcony',
            'garden'
        ];
    }

    /**
     * Return all valid office fields
     */
    public function getOfficeFields(): array
    {
        return [
            'office_type',
            'net_floor_space',
            'total_floor_space',
            'min_divisible',
            'floor',
            'number_of_floors',
            'base_rent',
            'total_rent',
            'price',
            'price_type',
            'free_from',
            'rent_duration',
            'price_on_inquiry',
            'rented',
            'heating_costs',
            'heating_costs_in_service_charge',
            'service_charge',
            'number_of_rooms',
            'number_of_parking_spaces',
            'parking_space_price',
            'condition',
            'last_refurbishment',
            'interior_quality',
            'flooring_type',
            'lan_cables',
            'air_conditioning',
            'lift',
            'barrier_free',
            'cellar',
            'has_canteen',
            'kitchen_complete',
            'high_voltage',
            'monument',
            'distance_to_pt',
            'distance_to_fm',
            'distance_to_mrs',
            'distance_to_airport'
        ];
    }

    /**
     * Return all valid gastronomy fields
     */
    public function getGastronomyFields(): array
    {
        return [
            'gastronomy_type',
            'net_floor_space',
            'total_floor_space',
            'base_rent',
            'price',
            'free_from',
            'price_on_inquiry',
            'rented',
            'condition',
            'last_refurbishment',
            'interior_quality',
            'number_of_rooms',
            'additional_area',
            'heating_costs',
            'heating_costs_in_service_charge',
            'service_charge',
            'number_seats',
            'number_beds',
            'number_of_floors',
            'number_of_parking_spaces',
            'parking_space_price',
            'lift',
            'terrace',
            'cellar',
            'monument',
            'distance_to_pt',
            'distance_to_fm',
            'distance_to_mrs',
            'distance_to_airport'
        ];
    }

    /**
     * Return all valid shop fields
     */
    public function getStoreFields(): array
    {
        return [
            'store_type',
            'net_floor_space',
            'total_floor_space',
            'min_divisible',
            'number_of_rooms',
            'base_rent',
            'total_rent',
            'price',
            'rent_subsidy',
            'price_type',
            'free_from',
            'price_on_inquiry',
            'rented',
            'location_classification_type',
            'shop_window_length',
            'additional_area',
            'heating_costs',
            'heating_costs_in_service_charge',
            'service_charge',
            'number_of_floors',
            'number_of_parking_spaces',
            'parking_space_price',
            'condition',
            'last_refurbishment',
            'interior_quality',
            'goods_lift_load',
            'goods_lift',
            'floor_load',
            'supply_type',
            'flooring_type',
            'lan_cables',
            'air_conditioning',
            'lift',
            'ramp',
            'cellar',
            'monument',
            'distance_to_pt',
            'distance_to_fm',
            'distance_to_mrs',
            'distance_to_airport'
        ];
    }

    /**
     * Return all valid warehouse fields
     */
    public function getIndustryFields(): array
    {
        return [
            'industry_type',
            'net_floor_space',
            'total_floor_space',
            'base_rent',
            'total_rent',
            'price',
            'rent_subsidy',
            'price_type',
            'free_from',
            'price_on_inquiry',
            'rented',
            'plot_area',
            'min_divisible',
            'additional_area',
            'heating_costs',
            'heating_costs_in_service_charge',
            'service_charge',
            'number_of_floors',
            'number_of_parking_spaces',
            'parking_space_price',
            'condition',
            'last_refurbishment',
            'interior_quality',
            'hall_height',
            'goods_lift_load',
            'goods_lift',
            'connected_load',
            'floor_load',
            'crane_runway_load',
            'flooring_type',
            'lift',
            'ramp',
            'auto_lift',
            'distance_to_pt',
            'distance_to_fm',
            'distance_to_mrs',
            'distance_to_airport'
        ];
    }

    /**
     * Return all valid special fields
     */
    public function getSpecialFields(): array
    {
        return [
            'special_purpose_type',
            'net_floor_space',
            'total_floor_space',
            'base_rent',
            'total_rent',
            'price',
            'price_type',
            'free_from',
            'price_on_inquiry',
            'plot_area',
            'min_divisible',
            'additional_area',
            'heating_costs',
            'heating_costs_in_service_charge',
            'service_charge',
            'number_of_floors',
            'number_of_parking_spaces',
            'parking_space_price',
            'condition',
            'last_refurbishment',
            'interior_quality',
            'flooring_type',
            'lift',
            'cellar',
            'monument',
            'distance_to_pt',
            'distance_to_fm',
            'distance_to_mrs',
            'distance_to_airport'
        ];
    }

    /**
     * Return all valid investment fields
     */
    public function getInvestmentFields(): array
    {
        return [
            'investment_type',
            'price',
            'price_per_sqm',
            'net_floor_space',
            'number_of_apartments',
            'number_of_commercials',
            'number_of_units',
            'rental_income_target',
            'rental_income_actual',
            'price_multiplier',
            'price_multiplier_target',
            'yield_target',
            'yield_actual',
            'investment_category',
            'purchase_form',
            'plot_area',
            'total_floor_space',
            'living_space',
            'industrial_area',
            'additional_area',
            'floor',
            'tenant_structure',
            'walt',
            'number_of_rooms',
            'number_of_single_rooms',
            'single_rooms_quota',
            'occupancy_rate',
            'number_of_vacancies',
            'service_charge',
            'other_costs',
            'conservation_areas',
            'condition',
            'last_refurbishment',
            'number_of_parking_spaces',
            'parking_space_type',
            'monument',
            'lift',
            'ramp',
            'auto_lift',
            'goods_lift',
            'cellar',
            'distance_to_pt',
            'distance_to_fm',
            'distance_to_mrs',
            'distance_to_airport'
        ];
    }

    /**
     * Return all valid energy fields
     */
    public function getEnergyFields(): array
    {
        return [
            'construction_year',
            'heating_type',
            'firing_types',
            'energy_certificate_availability',
            'building_energy_rating_type',
            'thermal_characteristic',
            'energy_efficiency_class',
            'energy_certificate_start_date',
            'energy_certificate_end_date'
        ];
    }

    /**
     * Return all valid courtage fields
     */
    public function getCourtageFields(): array
    {
        return [
            'courtage',
            'courtage_note',
            'deposit'
        ];
    }

    /**
     * Return all valid connection fields
     */
    public function getConnectionFields(): array
    {
        return [
            'relationships_attributes'
        ];
    }
}
