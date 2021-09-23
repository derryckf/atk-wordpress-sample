<?php
/**
 * Sub panel for event options.
 */

namespace atksample\panels\options;

use Atk4\Ui\JsNotify;
use Atk4\Ui\Form;
use atkwp\models\Options;
use atkwp\components\PanelComponent;

class OptionSubPanel extends PanelComponent
{
    protected function init() :void
    {
	parent::init();
        $optionModel = new Options($this->getDbConnection());
        $options = $optionModel->getOptionValue('atk4wp-event-options', null);

        $form = new \Atk4\Ui\Form('segment');
        $this->add($form);
        $form->addHeader('Select default category for event');
        $form->addControl(
            'category',
            [
                Form\Control\Dropdown::class,
                'caption' => 'Using values with default text',
                'empty' => 'Choose an option',
                'values'=>['Weekly', 'Monthly', 'Yearly'],
            ]
        );
  

        $form->onSubmit(function($form) use ($optionModel, $options) {
            $options['event-default'] = $form->model->get('category');
            $optionModel->saveOptionValue('atk4wp-event-options', $options);
            return new JsNotify('Options are saved', $this);
        });
    }
}
