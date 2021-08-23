<?php
	namespace Project\Controllers;
	use \Core\Controller;
	use \Project\Models\Hello;

	class HelloController extends Controller
	{
		public function index()
		{
			$this->title = 'Фреймворк работает!';

			// тестовая модель для проверки базы
			$hello = new Hello;

			return $this->render('hello/index');
		}
	}
