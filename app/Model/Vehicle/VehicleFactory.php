<?php
/**
 * Created by PhpStorm.
 * User: daryakiryanova
 * Date: 25.02.2018
 * Time: 11:42
 */

namespace Model\Vehicle;


class VehicleFactory
{
	private static $__vehicles;
	
	/**
	 * FactoryMethod + FlyWeight
	 *
	 * @param $type
	 *
	 * @return IVehicle
	 */
	public static function getVehicle($type) : IVehicle
	{
		$vehicle = null;
		
		if (isset(self::$__vehicles[$type]))
		{
			$vehicle = self::$__vehicles[$type];
		}
		else
		{
			switch ($type)
			{
				case 'train':
					$vehicle = new Train();
					break;
				case 'bus':
					$vehicle = new Bus();
					break;
				case 'plane':
					$vehicle = new Plane();
			}
			
			self::$__vehicles[$type] = $vehicle;
		}
		
		return $vehicle;
	}
}