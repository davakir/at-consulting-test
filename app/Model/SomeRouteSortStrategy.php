<?php
/**
 * Created by PhpStorm.
 * User: daryakiryanova
 * Date: 25.02.2018
 * Time: 12:09
 */

namespace Model;


class SomeRouteSortStrategy implements ISortable
{
	private $__unsortedRoutes;
	
	private $__sortedRoutes;
	
	/**
	 * @param array $routes
	 *
	 * @return array
	 *
	 * @throws \Exception
	 */
	public function sort(array $routes): array
	{
		$this->__unsortedRoutes = $routes;
		
		$this->__sortedRoutes = [array_shift($this->__unsortedRoutes)];
		
		while (count($this->__unsortedRoutes))
		{
			if (!$this->__doSort())
			{
				throw new \Exception('Невозможно составить маршрут.');
			}
		}
		
		return $this->__sortedRoutes;
	}
	
	/**
	 * Собственно, сортировка.
	 * Возвращает признак того, было ли что-нибудь переставлено местами.
	 *
	 * @return bool
	 */
	private function __doSort() : bool
	{
		$unsortedRoutesSize = count($this->__unsortedRoutes);
		
		$center = $this->__getHalfOfTheNumber($unsortedRoutesSize);
		
		$matching = false;
		
		for ($begin = 0, $end = $unsortedRoutesSize - 1; $begin <= $center, $end >= $begin; $begin++, $end--)
		{
			if ($this->__getSortedFromPlace() == $this->__getCurrentDestinationPlace($begin))
			{
				$this->__pushRouteToTheHead($begin);
				$matching = true;
			}
			elseif ($this->__getSortedFromPlace() == $this->__getCurrentDestinationPlace($end))
			{
				$this->__pushRouteToTheHead($end);
				$matching = true;
			}
			elseif ($this->__getSortedDestinationPlace() == $this->__getCurrentFromPlace($begin))
			{
				$this->__pushRouteToTheTail($begin);
				$matching = true;
			}
			elseif ($this->__getSortedDestinationPlace() == $this->__getCurrentFromPlace($end))
			{
				$this->__pushRouteToTheTail($end);
				$matching = true;
			}
		}
		
		/*
		 * Данная инструкция необходима для сброса ключей массива неотсортированных элементов.
		 * Т.к. при удалении элемента из середины массива все ключи сохраняются,
		 * нужно принудительно их сбрасывать.
		 */
		sort($this->__unsortedRoutes);
		
		return $matching;
	}
	
	private function __getHalfOfTheNumber($number)
	{
		return ceil($number / 2);
	}
	
	private function __getSortedFromPlace()
	{
		return $this->__sortedRoutes[0]['from'];
	}
	
	private function __getSortedDestinationPlace()
	{
		$lastRouteIndex = count($this->__sortedRoutes) - 1;
		
		return $this->__sortedRoutes[$lastRouteIndex]['destination'];
	}
	
	private function __getCurrentFromPlace($key)
	{
		return $this->__unsortedRoutes[$key]['from'];
	}
	
	private function __getCurrentDestinationPlace($key)
	{
		return $this->__unsortedRoutes[$key]['destination'];
	}
	
	private function __pushRouteToTheHead($routeKey)
	{
		array_unshift($this->__sortedRoutes, $this->__unsortedRoutes[$routeKey]);
		$this->__flushSomeData($routeKey);
	}
	
	private function __pushRouteToTheTail($routeKey)
	{
		array_push($this->__sortedRoutes, $this->__unsortedRoutes[$routeKey]);
		$this->__flushSomeData($routeKey);
	}
	
	private function __flushSomeData($routeKey)
	{
		unset($this->__unsortedRoutes[$routeKey]);
	}
}