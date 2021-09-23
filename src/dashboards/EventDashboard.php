<?php
/**
 * Display a certain number of event in dashboard.
 */

namespace atksample\dashboards;

use Atk4\Ui\View;
use atksample\models;
use atkwp\components\DashboardComponent;
use atkwp\models\Options;

class EventDashboard extends DashboardComponent
{
    public $fieldName = 'atksample-dash-eventNum';
    public $eventNumberField;
    public $optionModel;
    public $options;

    protected function init():void
    {
        parent::init();

        $this->optionModel = new Options($this->getDbConnection());
        $this->options = $this->optionModel->getOptionValue('atk4wp-event-options', null);

        $this->eventNumberField = new \atkwp\ui\WpInput(
            [
                'field_name' => $this->fieldName,
                'field_id'   => $this->fieldName,
                'value'      => (isset($this->options[$this->fieldName])) ? $this->options[$this->fieldName] : 2,
                'label'      => 'How many events to display:',
                'type'       => 'number',
                'css'        => 'tiny-text',
            ]
        );

        if ($this->configureMode) {
            $this->doConfigureMode();
        } else {
            $this->doDisplayMode();
        }
    }

    public function doDisplayMode()
    {
        $m = new models\Event($this->getDbConnection(), ['table' => $this->getPluginInstance()->getDbTableName('event')]);
        $m->tryLoadAny()->setOrder('date', 'DESC')->setLimit($this->options[$this->fieldName]);

        $this->add('Table')->setModel($m);
    }

    public function doConfigureMode()
    {
        $value = @$_POST[$this->fieldName];
        if (isset($value)) {
            $this->eventNumberField->setValue($value);
            $this->options[$this->fieldName] = $value;
            $this->optionModel->saveOptionValue('atk4wp-event-options', $this->options);
        }
        $this->add($this->eventNumberField);
    }
}
