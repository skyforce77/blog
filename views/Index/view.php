

<?php
  //TOREMOVE
  $articles = array(
    array('title'=>'Test', 'summary'=>'Résumé ici')
  );
  foreach ($articles as $value) {
    echo '<div class="panel"><div class="heading">';
    echo '<span class="title">'.$value['title'].'</span></div>';
    echo '<div class="content">'.$value['summary'].'</div>';
    echo '</div>';
  }
?>
