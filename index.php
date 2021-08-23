<?php
	namespace Core;

	error_reporting(E_ALL);
	ini_set('display_errors', 'on');

	require_once $_SERVER['DOCUMENT_ROOT'] . '/project/config/connection.php';

	//реализация автозагрузки классов
	spl_autoload_register(function($class)
	{
		preg_match('#(.+)\\\\(.+?)$#', $class, $match);

		$namespace = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($match[1]));
		$class_name = $match[2];

		$path = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $namespace . DIRECTORY_SEPARATOR . $class_name . '.php';

		if (file_exists($path)) {
			require_once $path;

			if (class_exists($class, false))
			{
				return true;
			}
			else
			{
				throw new \Exception("Класс $class не найден в файле $path. Проверьте правильность написания имени класса внутри указанного файла.");
			}
		}
		else
		{
			throw new \Exception("Для класса $class не найден файл $path. Проверьте наличие файла по указанному пути. Убедитесь, что пространство имен вашего класса совпадает с тем, которое пытается найти фреймворк для данного класса.");
		}
	});

	//массив с роутами
	$routes = require $_SERVER['DOCUMENT_ROOT'] . '/project/config/routes.php';


	// использование роутера
	$track = ( new Router )      -> get_track($routes, $_SERVER['REQUEST_URI']);

	$page  = ( new Dispatcher )  -> get_page($track);

	echo (new View) -> render($page);
