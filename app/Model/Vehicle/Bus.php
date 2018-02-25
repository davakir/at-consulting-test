<?php
/**
 * Created by PhpStorm.
 * User: daryakiryanova
 * Date: 25.02.2018
 * Time: 11:49
 */

namespace Model\Vehicle;


class Bus implements IVehicle
{
	private $__from;
	
	private $__to;
	
	private $__routeNumber;
	
	private $__seat;
	
	public function setRouteParams(array $params)
	{
		$this->__from = $params['from'];
		$this->__to = $params['destination'];
		
		$this->__routeNumber = ($params['params']['routeNumber']) ?? null;
		$this->__seat = ($params['params']['seat']) ?? null;
		
		return $this;
	}
	
	public function getRouteDescription(): string
	{
		$description = '';
		
		if (!empty($this->__routeNumber))
		{
			$description .= "Take the bus number $this->__routeNumber from $this->__from to $this->__to. ";
		}
		else
		{
			$description .= "Take any bus from $this->__from to $this->__to. ";
		}
		
		if (!empty($this->__seat))
		{
			$description .= "Seat $this->__seat.";
		}
		else
		{
			$description .= 'No seat assigned.';
		}
		
		return $description;
	}
}