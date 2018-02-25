<?php
/**
 * Created by PhpStorm.
 * User: daryakiryanova
 * Date: 25.02.2018
 * Time: 11:50
 */

namespace Model\Vehicle;


class Plane implements IVehicle
{
	private $__from;
	
	private $__to;
	
	private $__routeNumber;
	
	private $__seat;
	
	private $__luggage;
	
	public function setRouteParams(array $params)
	{
		$this->__from = $params['from'];
		$this->__to = $params['destination'];
		
		$this->__routeNumber = ($params['params']['routeNumber']) ?? null;
		$this->__seat = ($params['params']['seat']) ?? null;
		$this->__luggage = ($params['params']['luggage']) ?? null;
		
		return $this;
	}
	
	public function getRouteDescription(): string
	{
		$description = '';
		
		if (!empty($this->__routeNumber))
		{
			$description .= "Take the flight number $this->__routeNumber from $this->__from to $this->__to. ";
		}
		else
		{
			$description .= "Take any flight from $this->__from to $this->__to. ";
		}
		
		if (!empty($this->__seat))
		{
			$description .= "Seat $this->__seat. ";
		}
		else
		{
			$description .= 'No seat assigned. ';
		}
		
		if (!empty($this->__luggage))
		{
			$description .= "You can only take $this->__luggage kg registered luggage.";
		}
		else
		{
			$description .= 'The weight of your luggage is not limited.';
		}
		
		return $description;
	}
}