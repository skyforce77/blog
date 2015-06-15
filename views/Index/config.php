
<div class="container page-content">

	<div class="warning_message">Si le .htaccess n'a pas été créé il sera fait au chargement de cette page.<br>
		Vous n'aurez qu'à modifier le chemin jusqu'a la racine du blog à la ligne "RewriteBase" en cas de problème
	</div>

	<div class="warning_message">Tout les champs sont obligatoirs sauf celui du mot de passe<br>
		Si vous n'avez pas de mot de passe laissez le champ vide.
	</div>

    <div class="panel border-black">
    	
		<div class="heading">
			<span class="title text-shadow">Creation du fichier de configuration de la BDD</span>
    	</div>
    	<div class="content">
    		<?php
    		if(isset($error)){
    			echo '<div class="error_message">'.$error.'</div>';
    		}else if(isset($success)){
    			echo '<div class="success_message">'.$success.'</div>';
    		}
    		?>

			<form action="#" method="POST">
				<div class="input-control text">
					<input type="text" name="user" placeholder="Nom d'utilisateur">
				</div>
				<br>
				<div class="input-control text">
					<input type="password" name="password" placeholder="Mot de passe">
				</div>
				<br>
				<div class="input-control text">
					<input type="text" name="host" placeholder="Adresse de l'hote">
				</div>
				<br>
				<div class="input-control text">
					<input type="text" name="dbname" placeholder="Nom de la base de donnée">
				</div>
				<br>
				<input class="button" type="submit" value="Envoyer">
			</form>
		</div>
    </div>		    
	
</div>