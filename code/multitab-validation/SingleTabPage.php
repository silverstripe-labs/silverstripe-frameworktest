<?php

namespace SilverStripe\FrameworkTest\Model;

use Page;
use SilverStripe\Forms\Validation\RequiredFieldsValidator;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\Validation\CompositeValidator;

if (!class_exists(Page::class)) {
    return;
}

/**
 * This class is specifically for the silverstripe/admin behat test multitab-validation.feature
 */
class SingleTabPage extends Page
{
    private static $table_name = 'SingleTabPage';

    public function getCMSCompositeValidator(): CompositeValidator
    {
        $validator = parent::getCMSCompositeValidator();
        $validator->addValidator(new RequiredFieldsValidator(['Content']));
        return $validator;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        // Page may will extend CWP BasePage if running in a kitchen-sink context,
        // so removing any extra tabs added - this class is for a "single tab" test
        $tabFieldNames = [];
        foreach ($fields->flattenFields() as $field) {
            $fieldName = $field->getName();
            if (is_a($field, Tab::class) && $fieldName !== 'Main') {
                $tabFieldNames[] = $fieldName;
            }
        }
        foreach ($tabFieldNames as $tabFieldName) {
            $fields->removeByName($tabFieldName);
        }
        return $fields;
    }
}
