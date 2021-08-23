<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/project/webroot/styles.css?v=1"><!-- CSS из папки webroot(ресурсы (CSS,js,images)) -->
		<title><?= $title ?></title> <!-- выводим тайтл страницы -->
	</head>
	<body>
		<header class="header">
			хедер сайта
		</header>
		<div class="container">
			<aside class="sidebar left">
				левый сайдбар
			</aside>
			<main>
				<?= $content ?>
			</main>
			<aside class="sidebar right">
				правый сайдбар
			</aside>
		</div>
		<footer>
			футер сайта
		</footer>
	</body>
</html>