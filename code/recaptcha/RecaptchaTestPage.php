<?php

use SilverStripe\Forms\TextField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\Validation\RequiredFieldsValidator;
use SilverStripe\Forms\Form;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPResponse;

class RecaptchaTestPage extends Page
{
}

class RecaptchaTestPage_Controller extends PageController
{

    public function Form()
    {
        $fields = new FieldList(
            new TextField('MyText')
        );
        if (class_exists('RecaptchaField')) {
            $fields->push(new RecaptchaField('MyRecaptcha'));
        } else {
            $fields->push(new LiteralField('<p class="message error">RecaptchaField class not found</p>'));
        }

        $form = new Form(
            $this,
            'Form',
            $fields,
            new FieldList(
                new FormAction('submit', 'submit')
            ),
            new RequiredFieldsValidator(array('MyText'))
        );

        return $form;
    }

    public function submit(array $data, Form $form): HTTPResponse
    {
        $form->sessionMessage('Hooray!', 'good');

        return Director::redirectBack();
    }
}
