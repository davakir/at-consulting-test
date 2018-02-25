<?php

namespace Model\Vehicle;


interface IVehicle
{
	/**
	 * @param array $params
	 *
	 * @return $this
	 */
	public function setRouteParams(array $params);
	
	/**
	 * @return string
	 */
	public function getRouteDescription() : string;
}