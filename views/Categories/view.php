<div class="app-bar" data-role="appbar">
	<a class="app-bar-element" href="./"><span class="mif-home"></span> Accueil</a>
	<span class="app-bar-divider"></span>
	<ul class="app-bar-menu">
		<li>
			<a href="" class="dropdown-toggle">Catégories</a>
			<ul class="d-menu" data-role="dropdown">
				<?php
					foreach ($categories as $value) {
					   echo '<li><a href="#">'.ucfirst($value['name']).'</a></li>';
					}
				?>
			</ul>
		</li>
		<li><?php echo html::link('Accès rédacteur', array('controller'=>'Editors', 'view'=>'login')); ?>
	</ul>
	<span class="app-bar-pull"></span>
</div>

<?php
  //TOREMOVE
  $idCategorie = 0;
  $articles = array(
    array('title'=>'Test', 'summary'=>'Résumé random')
  );
  foreach ($categories as $value) {
	if($value['id'] == $idCategorie) {
    		echo '<div class="panel"><div class="heading">';
    		echo '<span class="title">'.ucfirst($value['name']).'</span></div>';
    		echo '<div class="content">';
		foreach ($articles as $article) {
			echo '<div class="panel"><div class="heading">';
    			echo '<span class="title">'.$article['title'].'</span></div>';
    			echo '<div class="content">'.$article['summary'].'</div>';
			echo '</div>';
		}
    		echo '</div></div>';
	}
  }
?>
