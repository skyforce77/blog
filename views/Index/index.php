<div class="sticky">
  	<nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
		<ul class="title-area">
    			<li class="name">
    	 			<h1><a href="./">Accueil</a></h1>
    			</li>
  		</ul>

  		<section class="top-bar-section">
  			<ul class="left">
  				<li class="has-dropdown not-click">
					<a href="#">Catégories</a>
					<ul class="dropdown">
						<?php 
							foreach ($categories as $value) {
								echo '<li><a href="#">'.ucfirst($value['name']).'</a></li>';
							}

						?>
						
					</ul>
				</li>
  			</ul>
			<ul class="right">
				<li><a href="login.php">Accès rédacteur</a></li>
			</ul>
		</section>
	</nav>
</div>