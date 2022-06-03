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
            'outputlanguage',
            'countryIsoCodeType',
            'addMobileUrl'
        ]);

        $this->set(Options::MODE_CREATE, [
            'property' => $this->getAllPropertyFields()
        ]);

        $this->set(Options::MODE_EDIT, [
            'property' => $this->getAllPropertyFields()
        ]);
    }

    /**
     * Extended validation
     */
    public function validate(array $param, bool $includeRequestParameter = false): array
    {
        $validOptions = parent::validate($param, $includeRequestParameter);

        // Perform extra checks only in create mode
        if($this->mode !== self::MODE_CREATE)
        {
            return $validOptions;
        }

        if(!$this->isValid('property/rs_type'))
        {
            throw new ApiInvalidArgumentException('For creating objects the parameter `rs_type` is required');
        }

        return $validOptions;
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
            $this->getPlotFields(),
            $this->getGarageFields(),
            $this->getTemporaryLivingFields(),
            $this->getOfficeFields(),
            $this->getGastronomyFields(),
            $this->getShopFields(),
            $this->getWarehouseFields(),
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
     * Return all valid plot fields
     */
    public function getPlotFields(): array
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
     * Return all valid temporary living fields
     */
    public function getTemporaryLivingFields(): array
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
    public function getShopFields(): array
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
    public function getWarehouseFields(): array
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


    /*public function getObjectCategories(): array
    {
        return [
            "ROOF_STOREY", // "Dachgeschoss"
            "LOFT", // "Loft"
            "MAISONETTE", // "Maisonette"
            "PENTHOUSE", // "Penthouse"
            "TERRACED_FLAT", // "Terrassenwohnung"
            "GROUND_FLOOR", // "Erdgeschosswohnung"
            "APARTMENT", // "Etagenwohnung"
            "RAISED_GROUND_FLOOR", // "Hochparterre"
            "HALF_BASEMENT", // "Souterrain"
            "ATTIKA", // "Attikawohnung"
            "OTHER", // "Sonstige"
            "SINGLE_FAMILY_HOUSE", // "Einfamilienhaus"
            "TWO_FAMILY_HOUSE", // "Zweifamilienhaus"
            "TERRACE_HOUSE", // "Reihenhaus"
            "MID_TERRACE_HOUSE", // "Reihenmittelhaus"
            "TERRACE_END_HOUSE", // "Reihenendhaus"
            "END_TERRACE_HOUSE", // "Reiheneckhaus"
            "MULTI_FAMILY_HOUSE", // "Mehrfamilienhaus"
            "TOWNHOUSE", // "Stadthaus"
            "FINCA", // "Finca"
            "BUNGALOW", // "Bungalow"
            "FARMHOUSE", // "Bauernhaus"
            "SEMIDETACHED_HOUSE", // "Doppelhaushälfte"
            "VILLA", // "Villa"
            "CASTLE_MANOR_HOUSE", // "Burg/Schloss"
            "SPECIAL_REAL_ESTATE", // "Besondere Immobilie"
            "TWIN_SINGLE_FAMILY_HOUSE", // "Doppeleinfamilienhaus"
            "TRADE_SITE", // "Grundstück"
            "GARAGE", // "Garage"
            "STREET_PARKING", // "Außenstellplatz"
            "CARPORT", // "Carport"
            "DUPLEX", // "Duplex"
            "CAR_PARK", // "Parkhaus"
            "UNDERGROUND_GARAGE", // "Tiefgarage"
            "DOUBLE_GARAGE", // "Doppelgarage"
            "OFFICE_LOFT", // "Loft"
            "STUDIO", // "Atelier"
            "OFFICE", // "Büro"
            "OFFICE_FLOOR", // "Büroetage"
            "OFFICE_BUILDING", // "Bürohaus"
            "OFFICE_CENTRE", // "Bürozentrum"
            "OFFICE_STORAGE_BUILDING", // "Büro-/ Lagergebäude"
            "SURGERY", // "Praxis"
            "SURGERY_FLOOR", // "Praxisetage"
            "SURGERY_BUILDING", // "Praxishaus"
            "COMMERCIAL_CENTRE", // "Gewerbezentrum"
            "LIVING_AND_COMMERCIAL_BUILDING", // "Wohn- und Geschäftsgebäude"
            "OFFICE_AND_COMMERCIAL_BUILDING", // "Büro- und Geschäftshaus"
            "BAR_LOUNGE", // "Barbetrieb/Lounge"
            "CAFE", // "Café"
            "CLUB_DISCO", // "Club/Diskothek"
            "GUESTS_HOUSE", // "Gästehaus"
            "TAVERN", // "Gaststätte"
            "HOTEL", // "Hotel"
            "HOTEL_RESIDENCE", // "Hotelanwesen"
            "HOTEL_GARNI", // "Hotel garni"
            "PENSION", // "Pension"
            "RESTAURANT", // "Restaurant"
            "SHOWROOM_SPACE", // "Ausstellungsfläche"
            "SHOPPING_CENTRE", // "Einkaufszentrum"
            "FACTORY_OUTLET", // "Factory Outlet"
            "DEPARTMENT_STORE", // "Kaufhaus"
            "KIOSK", // "Kiosk"
            "STORE", // "Laden"
            "SELF_SERVICE_MARKET", // "SB-Markt"
            "SALES_AREA", // "Verkaufsfläche"
            "SALES_HALL", // "Verkaufshalle"
            "RESIDENCE", // "Anwesen"
            "FARM", // "Bauernhof"
            "HORSE_FARM", // "Reiterhof"
            "VINEYARD", // "Weingut"
            "REPAIR_SHOP", // "Werkstatt"
            "LEISURE_FACILITY", // "Freizeitanlage"
            "COMMERCIAL_UNIT", // "Gewerbeeinheit"
            "INDUSTRIAL_AREA", // "Gewerbefläche"
            "SPECIAL_ESTATE", // "Spezialobjekt"
            "INVEST_FREEHOLD_FLAT", // "Eigentumswohnung"
            "INVEST_SINGLE_FAMILY_HOUSE", // "Einfamilienhaus"
            "INVEST_MULTI_FAMILY_HOUSE", // "Mehrfamilienhaus"
            "INVEST_LIVING_BUSINESS_HOUSE", // "Wohn/Geschäftshaus"
            "INVEST_HOUSING_ESTATE", // "Wohnanlage"
            "INVEST_MICRO_APARTMENTS", // "Micro-Apartments"
            "INVEST_OFFICE_BUILDING", // "Bürohaus"
            "INVEST_COMMERCIAL_BUILDING", // "Geschäftshaus"
            "INVEST_OFFICE_AND_COMMERCIAL_BUILDING", // "Büro- und Geschäftshaus"
            "INVEST_SHOP_SALES_FLOOR", // "Laden/Verkaufsfläche"
            "INVEST_SUPERMARKET", // "Supermarkt"
            "INVEST_SHOPPING_CENTRE", // "Einkaufszentrum"
            "INVEST_RETAIL_PARK", // "Fachmarktzentrum"
            "INVEST_HOTEL", // "Hotel"
            "INVEST_BOARDING_HOUSE", // "Boarding House"
            "INVEST_SURGERY_BUILDING", // "Ärztehaus"
            "INVEST_CLINIC", // "Klinik"
            "INVEST_ASSISTED_LIVING", // "Betreutes Wohnen"
            "INVEST_COMMERCIAL_CENTRE", // "Gewerbepark"
            "INVEST_HALL_STORAGE", // "Halle/Logistik"
            "INVEST_INDUSTRIAL_PROPERTY", // "Produktion/Fertigung"
            "INVEST_CAR_PARK" // "Parkhaus"
        ];
    }*/
}
