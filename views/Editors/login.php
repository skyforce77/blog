<?php if($login_state == 1): ?>
			<script>
				$.Notify({
					caption: 'Connexion',
					content: 'La connexion a échoué',
					type: 'alert',
					icon: "<span class='mif-user'></span>"
				});
			</script>
<?php endif ?>
<?php if($login_state == 0): ?>
			<script>
				$.Notify({
					caption: 'Connexion',
					content: 'Connexion réussie!',
					type: 'success',
					icon: "<span class='mif-user'></span>"
				});
			</script>
<?php endif ?>
<?php if($login_state == 2): ?>
			<script>
				$.Notify({
					caption: 'Déconnexion',
					content: 'Déconnexion réussie!',
					type: 'success',
					icon: "<span class='mif-user'></span>"
				});
			</script>
<?php endif ?>

<div>
	<br>
	<br>
	<div class="container page-content bg-white login-form">
		<?php if(isset($_SESSION['editor_id'])): ?>
			<br>
			<h1 class="text-light">Connecté</h1>
			<hr class="bg-teal">
			<form action="" method="POST">
				<input type="hidden" name="logout" value="">
				<?php echo html::link('<span class="mif-pencil"></span> Nouvel article', array('controller'=>'Posts', 'view'=>'add'), array('class'=>'button')); ?><br>
				<?php echo html::link('<span class="mif-user"></span> Profil', array('controller'=>'Editors', 'view'=>'profil', 'params'=>$_SESSION['editor_id']), array('class'=>'button')); ?><br>
				<button class="button" type="submit"><span class="mif-switch"></span> Se déconnecter</button>
			</form>
			<br>
		<?php else: ?>
			<form action="#" method="POST">
				<h1 class="text-light">Connexion</h1>
				<hr class="bg-teal">
				<br>
				<div class="input-control text">
					<input type="text" name="login" placeholder="Nom d'utilisateur">
				</div>
				<br>
				<div class="input-control password">
					<input type="password" name="passwd" placeholder="Mot de passe">
				</div>
				<br>
				<input class="button" type="submit" value="Se connecter">
				<?php echo html::link('S\'enregistrer', array('controller'=>'Editors', 'view'=>'signIn'), array('class'=>'button info fg-white')); ?>
			</form>
		<?php endif ?>
	</div>
	<br>
	<br>
</div>
