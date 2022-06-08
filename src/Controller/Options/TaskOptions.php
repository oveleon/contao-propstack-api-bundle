<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

final class TaskOptions extends Options
{
    const MODE_CREATE_REMINDER = 1001;
    const MODE_CREATE_EVENT = 1002;
    const MODE_CREATE_NOTE = 1003;
    const MODE_CREATE_INQUIRY = 1004;

    protected function configure(): void
    {
        $this->set(self::MODE_CREATE, array_merge_recursive(
            $this->getDefaultFields(),
            $this->getEventFields(),
            $this->getReminderFields(),
            $this->getInquiryFields()
        ));

        $this->set(self::MODE_CREATE_EVENT, array_merge_recursive(
            $this->getDefaultFields(),
            $this->getEventFields()
        ));

        $this->set(self::MODE_CREATE_REMINDER, array_merge_recursive(
            $this->getDefaultFields(),
            $this->getReminderFields()
        ));

        $this->set(self::MODE_CREATE_INQUIRY, array_merge_recursive(
            $this->getDefaultFields(),
            $this->getInquiryFields()
        ));

        $this->set(self::MODE_CREATE_NOTE, $this->getDefaultFields());
    }

    /**
     * Return field for all types of tasks
     */
    public function getDefaultFields(): array
    {
        return [
            'task' => [
                'note_type_id',
                'broker_id',
                'project_ids',
                'property_ids',
                'client_ids',
                'body',
                'title',
                'task_creator_id',
                'task_updater_id'
            ]
        ];
    }

    /**
     * Return field for reminder tasks
     */
    public function getReminderFields(): array
    {
        return [
            'task' => [
                'is_reminder',
                'remind_at',
                'due_date',
                'done'
            ]
        ];
    }

    /**
     * Return field for event tasks
     */
    public function getEventFields(): array
    {
        return [
            'task' => [
                'is_event',
                'starts_at',
                'ends_at',
                'private',
                'all_day',
                'location',
                'recurring',
                'rrule'
            ]
        ];
    }

    /**
     * Return field for inquiry tasks
     */
    public function getInquiryFields(): array
    {
        return [
            'task' => [
                'client_source_id'
            ]
        ];
    }
}
