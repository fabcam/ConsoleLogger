<?php
/**
 */
namespace ConsoleLogger\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use ConsoleLogger\Log\Logger;

use ArrayObject;


class LogBehavior extends Behavior
{

	public function beforeFind(Event $event , Query $query, ArrayObject $options, $primary)
	{
		$qry = $query->sql();
		$params = $query->valueBinder()->bindings();
		if(!empty($params)){
			$qry = $this->makeQuery($qry, $params);
		}
		Logger::log($qry, 'success');
	}

	private function makeQuery($qry, $params)
	{
		foreach ($params as $placeholder => $p) {
			$qry = str_replace($placeholder, "'" . $p['value'] . "'", $qry);
		}
		return $qry;
	}
}
