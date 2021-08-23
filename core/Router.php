<?php
	namespace Core;

	class Router
	{
		// определяем, какой из роутов соответвует данному uri($uri)
		public function get_track($routes, $uri)
		{
			foreach ($routes as $route)
			{
				$pattern = $this->create_pattern($route->path); // см. описание метода

				//Проверяем адрес URI на соответствие регулярке ,если URI подойдет под регулярку, в $params будут параметры

				if (preg_match($pattern, $uri, $params))
				{
					//нужно получить параметры из uri
					$params = $this->clear_params($params);
					return new Track($route->controller, $route->action, $params);
				}
			}
			// если ни один роут не подойдет
			return new Track('error', 'notFound');
		}

			/*
			Метод преобразует путь из роута в регуляку,
			подставляя вместо параметров роута именованные карманы


			к примеру, из адреса '/test/:var1/:var2/' метод
			сделает регулярку '#^/test/(?<var1>[^/]+)/(?<var2>[^/]+)/?$#'
		*/


		private function create_pattern($path)
		{
			return '#^' . preg_replace('#/:([^/]+)#', '/(?<$1>[^/]+)', $path) . '/?$#';
		}

		private function clear_params($params)
		{
			$result = [];

			foreach ($params as $key => $param)
			{
				if (!is_int($key))
				{
					$result[$key] = $param;
				}
			}

			return $result;
		}
	}


