<?php
/**
 * Display a simple registration form using a shortcode.
 */

/**
 * insert this code "[atksample-form]" into a page to get the register form display in Wp front end.
 */

namespace atksample\shortcodes;

use atkwp\components\ShortcodeComponent;

class FormShortcode extends ShortcodeComponent
{
    protected function init():void
    {
        parent::init();

        $form = \Atk4\Ui\Form::addTo($this);    
        $form->addControl('email');
        $form->onSubmit(function ($form) {
            if (!$form->model->get('email') || empty($form->model->get('email'))) {
                return $form->error('email', 'Please add valid email');
            }
            // implement subscribe here
            return $form->success('Subscribed '.$form->model->get('email').' to newsletter.');
        });
    }
}
