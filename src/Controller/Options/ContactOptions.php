<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class ContactOptions extends Options
{
    const MODE_READ_SINGLE = 2001;
    const MODE_CREATE_FAVORITE = 2002;

    protected function configure(): void
    {
        $this->set(Options::MODE_READ, [
            'page',
            'per',
            'expand',
            'project_ids',
            'phone_number',
            'q',
            'archived'
        ]);

        $this->set(self::MODE_READ_SINGLE, [
            'include',
            'identifier'
        ]);

        $this->set(self::MODE_CREATE_FAVORITE, [
            'client_id',
            'property_id',
            'identifier'
        ]);

        $this->set(Options::MODE_CREATE, [
            'client' => $this->getFields()
        ]);

        $this->set(Options::MODE_EDIT, [
            'client' => $this->getFields(),
            'identifier'
        ]);
    }

    public function getFields()
    {
        return [
            'broker_id',
            'parent_id',
            'is_company',
            'item_id',
            'salutation',
            'academic_title',
            'first_name',
            'last_name',
            'email',
            'home_cell',
            'home_phone',
            'home_street',
            'home_house_number',
            'home_zip_code',
            'home_city',
            'home_country',
            'office_phone',
            'office_cell',
            'dob',
            'birth_name',
            'birth_place',
            'birth_country',
            'identity_number',
            'issuing_authority',
            'tax_identification_number',
            'rating',
            'description',
            'company',
            'position',
            'emails',
            'full_salutation',
            'language',
            'income',
            'newsletter',
            'accept_contact',
            'warning_notice',
            'client_source_id',
            'client_status_id',
            'archived',
            'last_contact_at',
            'created_at',
            'updated_at',
            'creator_id',
            'updater_id',
            'gdpr_status',
            'keep_data_till',
            'client_reason_id',
            'cp_delete_request_date',
            'custom_fields'
        ];
    }
}
