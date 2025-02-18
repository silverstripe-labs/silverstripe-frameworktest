<?php

namespace SilverStripe\FrameworkTest\SudoMode;

use SilverStripe\Control\Session;
use SilverStripe\Forms\Form;
use SilverStripe\Core\Extension;

/**
 * Extension that will make it as if sudo mode is active for the current session
 * Intended to be used with behat tests so that there is no need to enter a password
 * when testing forms that require sudo mode
 *
 * @extends Extension<Form>
 */
class ActivateSudoModeServiceExtension extends Extension
{
    public function updateCheck(bool &$active, Session $session)
    {
        $active = true;
    }
}
