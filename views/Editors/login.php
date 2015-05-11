<div class="bg-blue">
	<br>
	<br>
	<div class="container page-content bg-white login-form">
		<?php if($session_state == 1): ?>
			<br>
			<h1 class="text-light">Déjà connecté</h1>
			<hr class="bg-grayLighter">
			<br>
		<?php else: ?>
			<form action="#" method="POST">
				<h1 class="text-light">Connexion</h1>
				<hr class="bg-teal">
				<br>
				<div class="input-control text <?php echo $session_state == 0 ? 'error' : '' ?>">
					<input type="text" name="login" placeholder="Nom d'utilisateur">
				</div>
				<br>
				<div class="input-control password <?php echo $session_state == 0 ? 'error' : '' ?>">
					<input type="password" name="passwd" placeholder="Mot de passe">
				</div>
				<br>
				<input class="button" type="submit" value="Se connecter">
				<?php echo html::link('S\'enregistrer', array('controller'=>'Editors', 'view'=>'signIn'), array('class'=>'button')); ?>
			</form>
		<?php endif ?>
	</div>
	<br>
	<br>
</div>
