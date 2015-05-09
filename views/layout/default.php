<?php
	if(!isset($background))
		$background = 'bg-lighterBlue';
?>
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
	<body class="<?php echo $background ?> large-back">
		<header>
			<div class="app-bar" data-role="appbar">
				<a class="app-bar-element" href="./"><span class="mif-home"></span> Accueil</a>
				<span class="app-bar-divider"></span>
				<ul class="app-bar-menu">
					<li>
						<a href="" class="dropdown-toggle">Catégories</a>
						<ul class="d-menu" data-role="dropdown">
							<?php
								$categories = Layouts::getCategories();
								foreach ($categories as $value) {
									$link = html::link(ucfirst($value['name']), array('controller' => 'Categories',  'view' => 'view', 'params' => $value['id']));
								  	echo '<li>'.$link.'</li>';
								}
							?>
						</ul>
					</li>
				</ul>
				<?php echo html::link('Accès rédacteur', array('controller'=>'Editors', 'view'=>'login'), array('class'=>'app-bar-element place-right')); ?>
				<span class="app-bar-pull"></span>
			</div>
		</header>

			<?php echo $layoutContent; ?>

		<foot>
		</foot>
	</body>
</html>
