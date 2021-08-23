<?php
	namespace Core;

	class View
	{
		public function render(Page $page)
		{
			return $this->render_layout($page, $this->render_view($page));
		}

		private function render_layout(Page $page, $content)
		{
			$layoutPath = $_SERVER['DOCUMENT_ROOT'] . "/project/layouts/{$page->layout}.php";

			if (file_exists($layoutPath))
			{
				ob_start();
					$title = $page->title;
					include $layoutPath;
				return ob_get_clean();
			}
			else
			{
				echo "Не найден файл с лейаутом по пути $layoutPath"; die();
			}
		}

		private function render_view(Page $page)
		{
			if ($page->view)
			{
				$viewPath = $_SERVER['DOCUMENT_ROOT'] . "/project/views/{$page->view}.php";

				if (file_exists($viewPath))
				{
					ob_start();
						$data = $page->data;
						extract($data);
						include $viewPath;
					return ob_get_clean();
				}
				else
				{
					echo "Не найден файл с представлением по пути $viewPath"; die();
				}
			}
		}
	}
