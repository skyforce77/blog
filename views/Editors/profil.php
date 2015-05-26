<div>
	<br>
	<br>
	<div class="container page-content bg-white login-form">
		<?php if(isset($user)): ?>
			<br>
			<h1 class="text-light">Profil</h1>
			<hr class="bg-teal">
			<br>
			<h2><?= ucfirst($user->getName()) ?></h2><br>
			<h3><?php
				if($user->isPublic()) {
					echo $user->getMail();
				} else {
					echo 'Mail privé';
				}
			?></h3><br>
			<hr class="bg-teal">
			<h3><?= $postsCount ?> posts:</h3>
		<?php else: ?>
			<h1>Cet éditeur n'existe pas</h1>
		<?php endif;

			$x = 0;
			foreach($posts as $value) {
				$x++;		
		?>
		<div class="panel border-black collapsible <?= $x <= 5 ? '' : 'collapsed' ?>" data-role="panel">
	      		<div class="heading">
				<span class="title text-shadow"><?= $value->getTitle(); ?></span>
	      			<span class ="date place-right text-secondary padding-right4em"><span class="mif-calendar mif-lg"></span> <?= $value->getDateCreation() ?></span><br>
	      		</div>
	      		<div class="content" style="word-wrap: break-word;">
				<div class="post_info text-small">
		   			<span class ="commentaires"><span class="mif-bubble fg-cobalt"></span> <?= $value->getNbrComments(); ?></span><br>
		   			<span class ="categories"><span class="mif-tag fg-cobalt"></span> <?= $value->getCategories(); ?></span><br>
		 		</div>
		 		<p><?= $value->getSummary() ?></p><br>
		 		<span class ="author text-small"><span class="mif-user"></span><?= $value->getAuthor(); ?></span>
				<div class="place-right">
					<span class="mif-chevron-right"></span>
					<?= html::link('Lire plus', array('controller'=>'Posts', 'view'=>'view', 'params'=>$value->getId())); ?>
				</div>
	      		</div>
	    	</div>
		<?php } ?>
	</div>
</div>
