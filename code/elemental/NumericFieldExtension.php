<?php

namespace SilverStripe\FrameworkTest\Elemental\Extension;

use SilverStripe\Forms\NumericField;
use SilverStripe\Core\Extension;
use SilverStripe\Core\Validation\ValidationResult;

/**
 * @extends Extension<NumericField>
 */
class NumericFieldExtension extends Extension
{
    protected function updateValidate(ValidationResult $result)
    {
        if ($this->owner->Value() == 1) {
            $result->addFieldError($this->owner->getName(), 'This field cannot be 1');
        }
    }
}
