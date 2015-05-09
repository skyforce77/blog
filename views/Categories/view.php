
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
