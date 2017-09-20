<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<base href="http://projects.localhost/kindcms/"/>
	<link href="web/assets/css/style.css" rel="stylesheet"/>
	<title>Home</title>
</head>
<body>
<header>
	<h1>KindCMS</h1>
</header>
<?php
foreach ( $articles as $article ): ?>
	<article>
		<h2><?php echo $article['art_title'] ?></h2>
		<p><?php echo $article['art_content'] ?></p>
	</article>
<?php endforeach ?>
<footer class="footer">
	<p>Septembre 2017 - Iteration 3</p>
</footer>
</body>
</html>