<?php if($postResult[0] == 1): ?>
			<script>
				$.Notify({
					caption: 'L\'enregistrement a échoué',
					content: '<?= $postResult[1] ?>',
					type: 'alert',
					icon: "<span class='mif-user'></span>"
				});
			</script>
<?php endif ?>
<?php if($sign_state == 0): ?>
			<script>
				$.Notify({
					caption: 'Enregistrement effectué',
					content: '<?= $postResult[1] ?>',
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
			<h1 class="text-light">Déjà connecté</h1>
			<hr class="bg-red">
		<?php else: ?>
			<form action="" method="POST">
				<h1 class="text-light">Enregistrement</h1>
				<hr class="bg-teal">
				<br>
				<div class="input-control text">
					<input type="text" name="login" placeholder="Nom d'utilisateur">
				</div>
				<br>
				<div class="input-control text">
					<input type="text" name="mail" placeholder="Adresse mail">
				</div>
				<div class="input-control text">
					<input type="text" name="mail2" placeholder="Confirmation de l'adresse mail">
				</div>
				<br>
				<div class="input-control password">
					<input type="password" name="passwd" placeholder="Mot de passe">
				</div>
				<div class="input-control password">
					<input type="password" name="passwd2" placeholder="Confirmation du mot de passe">
				</div>
				<br>
				<label class="switch">
					<p>Mail visible 
						<input type="checkbox" name="public">
						<span class="check"></span>
					</p>
				</label>
				<br>
				<input class="button" type="submit" value="S'enregistrer">
			</form>
		<?php endif ?>
	</div>
	<br>
	<br>
</div>