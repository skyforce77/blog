<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="theme-color" content="#0072c6">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<?php echo html::favicon('favicon.png'); ?>
		<?php echo html::css('metro.css'); ?>
		<?php echo html::css('metro-icons.css'); ?>
		<?php echo html::css('blog.css'); ?>
		<?php echo html::javascript('jquery.js'); ?>
		<?php echo html::javascript('metro.js'); ?>
		<title>Blog</title>
	</head>
	<body>
		<header>
			<div class="app-bar" data-role="appbar">
				<?php 
					echo html::link('<span class="mif-windows"></span> Accueil', null, array('class'=>'app-bar-element'));
					if(isset($_SESSION['editor_id'])) {
						echo html::link('<span class="mif-user"></span> '.ucfirst($_SESSION['editor_name']), array('controller'=>'Editors', 'view'=>'login'), array('class'=>'app-bar-element place-right'));
					} else {
						echo html::link('Accès rédacteur', array('controller'=>'Editors', 'view'=>'login'), array('class'=>'app-bar-element place-right'));
					}
				?>


			</div>
		</header>

		<?php echo $layoutContent; ?>
	</body>
</html>
