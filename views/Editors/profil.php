<div>
	<br>
	<br>
	<div class="container page-content bg-white login-form">
		<?php if(isset($user)): ?>
			<br>
			<h1 class="text-light">Profil</h1>
			<hr class="bg-teal">
			<br>
			<h2><?= ucfirst($user['name']) ?></h2><br>
			<h3><?php
				if((isset($_SESSION['editor_id']) && $_SESSION['editor_id'] == $user['id']) || $user['public'] == 1) {
					echo $user['mail'];
				} else {
					echo 'Mail privé';
				}
			?></h3><br>
		<?php else: ?>
			<h1>Cet éditeur n'existe pas</h1>
		<?php endif; ?>
	</div>
	<br>
	<br>
</div>
