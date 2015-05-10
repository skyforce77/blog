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
				<a class="app-bar-element" href="./"><span class="mif-home"></span> Accueil</a>
								
				<span class="app-bar-divider"></span>
				<?php echo html::link('Accès rédacteur', array('controller'=>'Editors', 'view'=>'login'), array('class'=>'app-bar-element')); ?>
				
				
			</div>
		</header>

			<?php echo $layoutContent; ?>

		<foot>
		</foot>
	</body>
</html>
