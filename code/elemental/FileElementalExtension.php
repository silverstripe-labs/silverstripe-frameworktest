<?php

namespace SilverStripe\FrameworkTest\Elemental\Extension;

use SilverStripe\Assets\File;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;

class FileElementalExtension extends Extension
{
    private static $has_one = [
        'MyFile' => File::class,
    ];

    private static $owns = [
        'MyFile',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('HTML');
    }
}
