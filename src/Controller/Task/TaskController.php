<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Task;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\TaskOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle task calls (category: for_reminders)
 *
 * @link https://docs.propstack.de/reference/aktivitaeten
 * @link https://docs.propstack.de/reference/task
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class TaskController extends PropstackController
{
    protected string $route = 'tasks';

    /**
     * Create a task of any type, e.g. notes or others that cannot be explicitly accessed in this controller.
     */
    public function create(array $parameters)
    {
        $this->call(
            (new TaskOptions(Options::MODE_CREATE))
                ->validate(['task' => $parameters]),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }

    /**
     * Create reminder (task)
     */
    public function createReminder(array $parameters)
    {
        // Several activities can be created via the task call. To handle only "tasks"
        // within the controller, the parameter `is_reminder` must be set to true.
        $parameters = array_merge($parameters, [
            'is_reminder' => true
        ]);

        $this->call(
            (new TaskOptions(TaskOptions::MODE_CREATE_REMINDER))
                ->validate(['task' => $parameters]),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }

    /**
     * Create event
     */
    public function createEvent(array $parameters)
    {
        // Several activities can be created via the task call. To handle only "tasks"
        // within the controller, the parameter `is_event` must be set to true.
        $parameters = array_merge($parameters, [
            'is_event' => true
        ]);

        $this->call(
            (new TaskOptions(TaskOptions::MODE_CREATE_EVENT))
                ->validate(['task' => $parameters]),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }

    /**
     * Create note
     */
    public function createNote(array $parameters)
    {
        $this->call(
            (new TaskOptions(TaskOptions::MODE_CREATE_NOTE))
                ->validate(['task' => $parameters]),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }

    /**
     * Create inquiry
     */
    public function createInquiry(array $parameters)
    {
        $this->call(
            (new TaskOptions(TaskOptions::MODE_CREATE_INQUIRY))
                ->validate(['task' => $parameters]),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }
}
