<?php

namespace SilverStripe\FrameworkTest\Elemental\Model;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\FrameworkTest\Model\Company;

if (!class_exists(BaseElement::class)) {
    return;
}

class HasGridFieldElementalBlock extends BaseElement
{
    private static $table_name = 'HasGridFieldElementalBlock';

    private static string $singular_name = 'Has GridField Elemental Block';

    private static string $plural_name = 'Has GridField Elemental Blocks';

    private static $many_many = [
        'Companies' => Company::class,
    ];

    private static $inline_editable = false;

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('Companies');
        $fields->addFieldToTab(
            'Root.Main',
            GridField::create(
                'Companies',
                'Companies',
                $this->Companies(),
                GridFieldConfig_RelationEditor::create()
            )
        );
        return $fields;
    }
}
