<?php
/**
 * Created by PhpStorm.
 * User: daryakiryanova
 * Date: 25.02.2018
 * Time: 12:03
 */

namespace Model;

use Model\Vehicle\VehicleFactory;

class Route
{
	public static function sortRoutes(array $routes, ISortable $sortStrategy) : array
	{
		return $sortStrategy->sort($routes);
	}
	
	public static function generateRoutesDescription(array $routes) : array
	{
		$descriptions = [];
		
		foreach ($routes as $route)
		{
			$vehicle = VehicleFactory::getVehicle($route['vehicle']);
			
			$descriptions[] = $vehicle->setRouteParams($route)->getRouteDescription();
		}
		
		return $descriptions;
	}
}