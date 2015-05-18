<div class="container page-content">
  <div class="sort_bar" style = "margin-top:30px;">
    <!-- début tab -->
    <div class="tabcontrol tabs-bottom" data-role="tabControl">
      <ul class="tabs">
        <li><a href="#sort">Tri</a></li>
        <li><a href="#stat">Statistiques</a></li>
      </ul>
      <div class="frames">
        <div class="frame" id="sort">
          <form action="" class="sort_form" method="get">
            <label>Categories</label>
            <div class="input-control select">
              <select name="categorie" >
                <option>Toutes les catégories</option>
                <?php
                  $categories = Layouts::getCategories();
                  foreach ($categories as $value) {
                    $selected = '';
                    if(isset($_GET['categorie']) && $_GET['categorie'] == $value['id'])
                      $selected = 'selected';
                    echo '<option value="'.$value['id'].'"'.$selected.'>'.$value['name'].'</option>';
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
          <!-- TODO -->
        </div>
      </div>
    </div>
    <!-- fin tab -->
  </div>

  <?php
    $categories = Layouts::getCategories();
    
      if (count($posts) == 0){ ?>
        <br>
        <h3><span class="mif-warning fg-orange"></span> Aucun post dans cette catégorie</h3>
  <?php    } else {
      foreach ($posts as $value) {
  ?>
    <div class="panel border-black" style="margin-top:30px;">
      <div class="heading">
        <span class="title text-shadow"><?= $value['title'] ?></span>
        <span class ="date place-right text-secondary padding-right10"><span class="mif-calendar mif-lg"></span> <?= $value['date_creation'] ?></span><br>
      </div>
      <div class="content" style="word-wrap: break-word;">
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
      }
    }
    ?>

    <div class="pagination">
      <?php
      $options = "";      
      foreach ($_GET as $key => $value) {
        if($key != "page")
          $options .= "&".$key."=".$value;
      }
      if(isset($_GET['page']) && $_GET['page'] > 1){
        echo "<a class='item' href='?page=".($_GET['page']-1).$options."'><</a>";
      }else{
        echo "<span class='item disabled'><</span>";
      }
      if($nbrPages > 0){
        for($i=1; $i<=($nbrPages); $i++){
          $current = "";
          if($_GET['page'] == $i){
            $current = "current";
          }
          echo "<a class='item ".$current."' href='?page=".$i.$options."' >".$i."</a>";
        }
      }else{
        echo "<span class='item current'>1</span>";
      }
         
    
      if(isset($_GET['page']) && $_GET['page'] < $nbrPages){        
        echo "<a class='item' href='?page=".($_GET['page']+1).$options."'>></a>";
      }else{
        echo "<span class='item disabled'>></span>";
      }
?>

  </div>
</div>
