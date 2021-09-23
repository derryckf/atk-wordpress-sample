<?php
/**
 * Panel to display an Event CRUD.
 */

namespace atksample\panels;

use Atk4\Ui\View;
use atksample\models;
use atkwp\components\PanelComponent;

class t extends \Atk4\Data\Model
{
    protected function init(): void {
        parent::init();
        
        $this->addField('month');
        $this->addField('sales');
        $this->addField('purchases');
        $this->addField('profit');
    }
}

class EventPanel extends PanelComponent
{
	protected function init():void
	{
	    parent::init();

            $msg = $this->add(new \Atk4\Ui\Message([
                'Message',
                'Agile Toolkit for Wordpress!',
            ]));

            $p = new \Atk4\Data\Persistence\Static_([
                ['id' => 1, 'month' => 'January', 'sales' => 20000, 'purchases' => 10000],
                ['id' => 2, 'month' => 'February', 'sales' => 23000, 'purchases' => 12000],
                ['id' => 3, 'month' => 'March', 'sales' => 16000, 'purchases' => 11000],
                ['id' => 4, 'month' => 'April', 'sales' => 14000, 'purchases' => 13000],
            ]);
            //$m = new t($p);
        
            $m = new models\Event($this->getDbConnection(), ['table' => $this->getPluginInstance()->getDbTableName('event')]);
            $v = \Atk4\Ui\View::addTo($this, ['ui' => 'segment']);
            //$v = $this->add();
            $c = \Atk4\Ui\Crud::addTo($v);
            //$c->
            //$c = new \Atk4\Ui\Crud(['notifyDefault' => new \Atk4\Ui\JsNotify(['content'=>'Data saved'], $this)]);
            //$v->add($c);
            $c->setModel($m);
            //$c->itemCreate->set('Event');
	}
}
