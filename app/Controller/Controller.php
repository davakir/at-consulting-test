<?php

namespace Controller;
use Model\Route;
use Model\SomeRouteSortStrategy;

/**
 * Class Controller
 * @package Controller
 */
class Controller extends AbstractController
{
	/**
	 * @Route ("/" || "/home")
	 *
	 * @return array
	 */
	public function index()
	{
		return [
			'content' => $this->_view->render('index'),
			'title' => 'Главная страница'
		];
	}
	
	/**
	 * Передача списка карточек может быть как извне (передача POST или GET http-параметра),
	 * так и изнутри (генерируем в коде или получаем список из БД).
	 *
	 * Вывод описаний может быть как в виде массива, чтобы уже на фронте выводить в том виде,
	 * в каком необходимо, так и в готовом виде, тогда нужно будет изменить класс Route на
	 * реализацию от интерфейса, и изменить реализацию метода generateRoutesDescription.
	 *
	 * Формат входных данных: набор информации о каждом маршруте передвижения с параметрами
	 * 'from' -- Откуда передвигаемся
	 * 'destination' -- Куда передвигаемся
	 * 'vehicle' -- Средство предвижения
	 * 'params' -- Параметры в зависимости от средства передвижения:
	 *      (номер рейса, номер места, номер вагона, размер багажа)
	 *
	 * Формат выходных данных для API
	 * 'error' => string|null -- ошибка или ничего, если маршрут успешно составлен
	 * 'routes' => array -- описания маршрутов
	 *
	 * @Route ("/create/route")
	 *
	 * @return array
	 */
	public function createRoute()
	{
		$cards = $this->__getRouteCards();
		
		try
		{
			$sortedCards = Route::sortRoutes($cards, new SomeRouteSortStrategy());
			
			$routeDescriptions = Route::generateRoutesDescription($sortedCards);
			
			$result = [
				'error' => null,
				'routes' => $routeDescriptions,
			];
		}
		catch (\Exception $e)
		{
			$result = [
				'error' => $e->getMessage(),
				'routes' => [],
			];
		}
		
		return [
			'content' => $this->_view->render(
				'route',
				$result
			),
			'title' => 'Составленный маршрут',
		];
	}
	
	/**
	 * @return array
	 */
	private function __getRouteCards() : array
	{
		return [
			[
				'from' => 'Torino',
				'destination' => 'Firenze',
				'vehicle' => 'train',
				'params' => [
					'routeNumber' => 6768,
					'seat' => 34,
					'coach' => 8,
				],
			],
			[
				'from' => 'Bergamo',
				'destination' => 'Milano',
				'vehicle' => 'bus',
				'params' => [
					'routeNumber' => 12,
					'seat' => 0,
				],
			],
			[
				'from' => 'Firenze',
				'destination' => 'Rome',
				'vehicle' => 'train',
				'params' => [
					'routeNumber' => 7006,
					'seat' => 21,
					'coach' => 3,
				],
			],
			[
				'from' => 'Milano',
				'destination' => 'Torino',
				'vehicle' => 'train',
				'params' => [
					'routeNumber' => 6709,
					'seat' => 55,
				],
			],
			[
				'from' => 'Moscow',
				'destination' => 'Bergamo',
				'vehicle' => 'plane',
				'params' => [
					'routeNumber' => 'AY9006',
					'seat' => '18A',
					'luggage' => 23,
				],
			],
		];
	}
}