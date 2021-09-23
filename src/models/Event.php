<?php
/**
 * Model Event.
 * Create a model base on the event table in Db.
 */

namespace atksample\models;

use \Atk4\Data\Model;

class Event extends Model
{

	protected function init():void
	{
		parent::init();

		$this->addField('name', ['type'=> 'string', 'caption'=>'Name', 'required' => true]);

		$this->addField('description', ['type'=>'string', 'caption'=>'Description', 'required' => true]);
		$this->addField('category', ['enum' => ['week' => 'Weekly', 'month'=> 'Monthly', 'year'=>'Yearly'], 'required' => true]);
		$this->addField('date', ['type'=>'date', 'required' => true]);
	}
}
