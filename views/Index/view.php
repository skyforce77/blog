
<div class="sort_bar">
  <form action="" class="sort_form">
      <label>Categories</label>
      <select name="categorie" >
        <option>Toutes les catégories</option>
        <?php
          $categories = Layouts::getCategories();
          foreach ($categories as $value) {
            echo '<option>'.$value['name'].'</option>';
          }

        ?>
      </select>

      <label>Trier par</label>
      <select name="sort" >
        <option>Plus récent</option>
        <option>Moins récent</option>
        <option>Auteur A-Z</option>
        <option>Auteur Z-A</option>        
      </select>
  </form>
</div>

<?php
  $categories = Layouts::getCategories();
    foreach ($posts as $value) {
?>
    <div class="posts_summary">
      <div class="post_info">
        <span class ="date"><?= $value['date_creation'] ?></span>
        <span class ="commentaires"><?= $value['nbr_comments'] ?></span>
        <span class ="categories"><?= $value['categories'] ?></span>
      </div>
      <div class="text">
        <h2><?= $value['title'] ?></h2>
        <p><?= $value['summary'] ?></p>
        <span class ="auteur"><?= $value['author'] ?></span>
      </div>
    </div>
<?php
    }
?>
