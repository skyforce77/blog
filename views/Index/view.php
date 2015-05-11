<div class="container page-content">
  <div class="sort_bar">
    <form action="" class="sort_form" method="get">
        <label>Categories</label>
	<div class="input-control select">
		<select name="categorie" >
			<option>Toutes les catégories</option>
			<?php
			   $categories = Layouts::getCategories();
			   foreach ($categories as $value) {
			     $selected = '';
			     if(isset($_GET['categorie']) && $_GET['categorie'] == $value['name'])
				$selected = 'selected';
			     echo '<option '.$selected.'>'.$value['name'].'</option>';
			   }
			?>
		</select>
	</div>
        <label>Trier par</label>
	<div class="input-control select">
		<select>
			<option>Plus récent</option>
			<option>Moins récent</option>
			<option>Auteur A-Z</option>
			<option>Auteur Z-A</option> 
		</select>
	</div>
        <input type="submit" value="Trier">
    </form>
  </div>

  <?php
    $categories = Layouts::getCategories();
    
      if (count($posts) == 0){ ?>
        <br>
        <h3><span class="mif-warning fg-orange"></span> Aucun post dans cette catégorie</h3>
  <?php    } else {
      foreach ($posts as $value) {
  ?>
    <br>
    <div class="panel border-black">
      <div class="heading">
        <span class="title text-shadow"><?= $value['title'] ?></span>
        <span class ="date place-right text-secondary padding-right10"><span class="mif-calendar mif-lg"></span> <?= $value['date_creation'] ?></span><br>
      </div>
      <div class="content">
        <div class="post_info text-small">
          <span class ="commentaires"><span class="mif-bubble fg-cobalt"></span> <?= $value['nbr_comments'] ?></span><br>
          <span class ="categories"><span class="mif-tag fg-cobalt"></span> <?= $value['categories'] ?></span><br>
        </div>
        <p><?= $value['summary'] ?></p><br>
        <span class ="author text-small"><span class="mif-user"></span> <?= $value['author'] ?></span>
	<div class="place-right">
		<span class="mif-chevron-right"></span>
		<?= html::link('Lire plus', array('controller'=>'Posts', 'view'=>'view', 'params'=>$value['id'])) ?>
	</div>
      </div>
    </div>
  <?php
      }}
  ?>
</div>
