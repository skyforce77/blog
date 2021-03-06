<div class="container page-content">
  <div class="sort_bar" style = "margin-top:30px;">
    <!-- début tab -->
    <div class="tabcontrol2 tabs-bottom" data-role="tabControl">
      <ul class="tabs">
        <li><a href="#sort">Tri</a></li>
        <li><a href="#stat">Statistiques</a></li>
      </ul>
      <div class="frames">
        <div class="frame" id="sort">
          <form action="#" class="sort_form" method="get">
            <label>Categories</label>
            <div class="input-control select">
              <select name="categorie" >
                <option>Toutes les catégories</option>
                <?php
                  foreach ($categories as $value) {
                    $selected = '';
                    if(isset($_GET['categorie']) && $_GET['categorie'] == $value->getId())
                      $selected = 'selected';
                    echo '<option value="'.$value->getId().'"'.$selected.'>'.$value->getName().'</option>';
                  }

                ?>
              </select>
            </div>
            <label>Trier par</label>
            <div class="input-control select">
              <select name="sort">
                <option>Plus récent</option>
                <option>Moins récent</option>
                <option>Auteur A-Z</option>
                <option>Auteur Z-A</option> 
              </select>
            </div>
            <input type="submit" value="Trier">
          </form>
        </div>
        <div class="frame" id="stat">
          <table class="table">
            <thead>
              <tr><th>Catégories</th><th>Nombre d'articles</th></tr>
            </thead>
            <?php

              foreach($statsCategories as $value) {
                echo '<tr><td>'.$value->getName().'</td><td>'.$value->getNbrPosts().'</td></tr>';
              }
            ?>
          </table>
        </div>
      </div>
    </div>
    <!-- fin tab -->
  </div>

  <?php    
      if (empty($posts)){ ?>
        <br>
        <h3><span class="mif-warning fg-orange"></span> Aucun post dans cette catégorie</h3>
  <?php    } else {
      foreach ($posts as $value) {
  ?>
    <div class="panel border-black" style="margin-top:30px;">
      <div class="heading">
        <span class="title text-shadow"><?= $value->getTitle(); ?></span>
        <span class ="date place-right text-secondary padding-right10"><span class="mif-calendar mif-lg"></span> <?= $value->getDateCreation(); ?></span><br>
      </div>
      <div class="content" style="word-wrap: break-word;">
        <div class="post_info text-small">
          <span class ="commentaires"><span class="mif-bubble fg-cobalt"></span> <?= $value->getNbrComments(); ?></span><br>
          <span class ="categories"><span class="mif-tag fg-cobalt"></span> <?= $value->getCategories(); ?></span><br>
        </div>
        <p><?= $value->getSummary() ?></p><br>
        <span class ="author text-small"><span class="mif-user"></span><?= $value->getAuthor(); ?></span>
	<div class="place-right">
		<span class="mif-chevron-right"></span>
		<?= html::link('Lire plus', array('controller'=>'Posts', 'view'=>'view', 'params'=>$value->getId())); ?>
	</div>
      </div>
    </div>
  <?php
      }
    }
    ?>

    <div class="pagination">
      <?php
      $options = "";
      $page = 1;
      if(isset($_GET['page']))
        $page = $_GET['page']; 

      foreach ($_GET as $key => $value) {
        if($key != "page")
          $options .= "&".$key."=".$value;
      }
      if(isset($page) && $page > 1){
        echo "<a class='item' href='?page=".($page-1).$options."'>&lt;</a>";
      }else{
        echo "<span class='item disabled'>&lt;</span>";
      }
      if($nbrPages > 0){
        for($i=1; $i<=($nbrPages); $i++){
          $current = "";
          if($page == $i){
            $current = "current";
          }
          echo "<a class='item ".$current."' href='?page=".$i.$options."' >".$i."</a>";
        }
      }else{
        echo "<span class='item current'>1</span>";
      }
         
    
      if(isset($page) && $page < $nbrPages){        
        echo "<a class='item' href='?page=".($page+1).$options."'>></a>";
      }else{
        echo "<span class='item disabled'>&gt;</span>";
      }
?>

  </div>
</div>
