<?php
/**
 * Created by PhpStorm.
 * User: daryakiryanova
 * Date: 25.02.2018
 * Time: 11:48
 */

namespace Model\Vehicle;


class Train implements IVehicle
{
	private $__from;
	
	private $__to;
	
	private $__routeNumber;
	
	private $__seat;
	
	private $__coach;
	
	public function setRouteParams(array $params)
	{
		$this->__from = $params['from'];
		$this->__to = $params['destination'];
		
		$this->__routeNumber = ($params['params']['routeNumber']) ?? null;
		$this->__seat = ($params['params']['seat']) ?? null;
		$this->__coach = ($params['params']['coach']) ?? null;
		
		return $this;
	}
	
	public function getRouteDescription(): string
	{
		$description = '';
		
		if (!empty($this->__routeNumber))
		{
			$description .= "Take the train number $this->__routeNumber from $this->__from to $this->__to. ";
		}
		else
		{
			$description .= "Take any train from $this->__from to $this->__to. ";
		}
		
		if (!empty($this->__coach))
		{
			$description .= "Your coach is $this->__coach. ";
		}
		
		if (!empty($this->__seat))
		{
			if (!empty($this->__coach))
			{
				$description .= "Your seat is $this->__seat.";
			}
			else
			{
				$description .= "Your seat is $this->__seat in any coach.";
			}
		}
		else
		{
			$description .= 'No seat assigned';
		}
		
		return $description;
	}
}