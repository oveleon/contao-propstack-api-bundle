<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller;

/**
 * Trait for classes which allow the passing of custom fields
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
trait CustomFieldTrait
{
    private ?array $customFields = null;
    private bool   $partialMode = true;

    /**
     * Set custom fields
     *
     * Allows to add unknown option fields (they must be created in Propstack)
     */
    public function setCustomFields(array $fields, bool $partialMode = true): self
    {
        $this->customFields = $fields;
        $this->partialMode = $partialMode;

        return $this;
    }

    /**
     * Get custom fields
     */
    public function getCustomFields(): ?array
    {
        $key = $this->partialMode ? 'partial_custom_fields' : 'custom_fields';

        return [$key => $this->customFields];
    }
}
