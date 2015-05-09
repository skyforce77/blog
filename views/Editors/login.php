<div class="app-bar" data-role="appbar">
	<a class="app-bar-element" href="./"><span class="mif-home"></span> Accueil</a>
	<span class="app-bar-divider"></span>
	<ul class="app-bar-menu">
		<li><?php echo html::link('Connexion', array('controller'=>'Editors', 'view'=>'login')); ?>
		<li><?php echo html::link('Menu rédacteur', array('controller'=>'Editors', 'view'=>'view')); ?>
		<li><?php echo html::link('Profil', array('controller'=>'Editors', 'view'=>'profil')); ?>
	</ul>
	<span class="app-bar-pull"></span>
</div>

<div class="panel">
	<div class="heading">
		<span class="title">Connexion</span>
	</div>
	<div class="content">
		 <form action="#" method="POST">
			Nom d'utilisateur:<br>
			<input type="text" name="login">
			<br>
			Mot de passe:<br>
			<input type="password" name="passwd">
			<br>
			<input type="submit" value="Se connecter">
		</form> 
	</div>
</div>
