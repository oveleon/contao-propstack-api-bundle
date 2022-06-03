<?php
/**
 * Options:
 * This class is used to pass only valid parameters to the onOffice API to avoid errors.
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */

namespace Oveleon\ContaoPropstackApiBundle\Controller\Options;

use Contao\System;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * This class is used to pass only valid parameters to the Propstack API to avoid errors.
 *
 * Usage:
 *  $objOptions = new CustomOptions(Options::MODE_READ);
 *
 *  // Return all valid options
 *  $validReadParameter = $objOptions->get();
 *
 *  // Validate options by a given array
 *  $validReadOptions = $objOptions->validate(['myField']);
 *
 *  // Validate options by a given array accepts request parameters
 *  $validReadOptions = $objOptions->validate(['myField'], true);
 *
 *  // Check if a key is valid
 *  $blnPrice = $objOptions->isValid('myField');
 *
 *  // Add allowed parameters during runtime to the current mode
 *  $objOptions->add(['myField1', 'myField2']);
 *
 *  // Switch to another mode
 *  $objOptions->setMode(Options::MODE_CREATE);
 */
abstract class Options implements OptionsInterface
{
    const MODE_READ = 0;
    const MODE_EDIT = 1;
    const MODE_CREATE = 2;
    const MODE_DELETE = 4;
    const MODE_UPLOAD = 5;

    /**
     * Accepted modes
     * Defines the modes which are extended by the field configurations.
     */
    protected ?array $modes;

    /**
     * Current mode scope
     */
    protected int $mode;

    /**
     * Validated data
     */
    protected ?array $validated = null;

    /**
     * Parameter bag
     */
    protected array $parameters = [];

    public function __construct($mode)
    {
        // Apply configuration from child class
        $this->configure();

        // Set mode scope
        $this->setMode($mode);
    }

    /**
     * Configure valid options
     */
    abstract protected function configure(): void;

    /**
     * Set valid parameter additive by mode
     */
    protected function set(int $mode, array $data, bool $merge = true): void
    {
        if($merge)
        {
            $this->parameters[ $mode ] = array_merge_recursive($this->parameters[ $mode ] ?? [], $data);
            return;
        }

        $this->parameters[ $mode ] = $data;
    }

    /**
     * Set current mode
     */
    public function setMode(int $mode): void
    {
        $this->mode = $mode;
    }

    /**
     * Return all options by current mode
     */
    public function get(): array
    {
        return $this->parameters[ $this->mode ] ?? [];
    }

    /**
     * Set valid parameter additive by current mode
     */
    public function add(array $data): void
    {
        $this->set($this->mode, $data);
    }

    /**
     * Check if a key exists for validated data
     */
    public function isValid(string $key): bool
    {
        if(null === $this->validated)
        {
            throw new Exception('Use the validate method before executing isValid.');
        }

        if(!array_key_exists($this->mode, $this->validated))
        {
            throw new Exception('No validation has been performed yet for the mode used.');
        }

        if(strpos($key, '/') !== false)
        {
            $i=0;
            $keys = explode('/', $key);
            $search = $this->validated[ $this->mode ];

            foreach ($keys as $k)
            {
                if(array_key_exists($k, $search))
                {
                    if(++$i === count($keys))
                    {
                        return true;
                    }

                    $search = $search[$k];
                }else return false;
            }
        }

        if(array_key_exists($key, $this->validated[ $this->mode ]))
        {
            return true;
        }

        return false;
    }

    /**
     * Validate and return valid options
     */
    public function validate(array $param, bool $includeRequestParameter = false): array
    {
        $accepts = [];

        if($includeRequestParameter)
        {
            $request = System::getContainer()->get('request_stack')->getCurrentRequest();

            if($request->query->count())
            {
                foreach ($request->query->all() as $key => $value)
                {
                    if(is_array($value) && array_key_exists($key, $param))
                    {
                        foreach ($value as $v)
                        {
                            if(!in_array($v, $param[ $key ]))
                            {
                                $param[ $key ][] = $v;
                            }
                        }
                    }
                    elseif(!array_key_exists($key, $param))
                    {
                        $param[ $key ] = $value;
                    }
                }
            }
        }

        foreach (self::get() as $key => $val)
        {
            if(is_array($val) && array_key_exists($key, $param))
            {
                $accepts[ $key ] = [];

                foreach ($val as $v)
                {
                    switch ($this->mode)
                    {
                        // ToDo: Only CREATE and EDIT?
                        // list of valid key-value pairs
                        case self::MODE_CREATE:
                        case self::MODE_EDIT:
                            if(array_key_exists($v, $param[ $key ]))
                            {
                                $accepts[ $key ][ $v ] = $param[ $key ][ $v ];
                            }

                            break;

                        // list of valid keys
                        default:
                            if(in_array($v, $param[ $key ]))
                            {
                                $accepts[ $key ][] = $v;
                            }
                    }
                }

                continue;
            }

            if(!is_array($val) && array_key_exists($val, $param))
            {
                $accepts[ $val ] = $param[ $val ];
            }
        }

        $this->validated[ $this->mode ] = $accepts;

        return $accepts;
    }
}
