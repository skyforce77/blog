<div class="container page-content">
  <div class="sort_bar" style = "margin-top:30px;">
    <form action="" class="sort_form" method="get">
        <label>Categories</label>
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

        <label>Trier par</label>
        <select name="sort" >
          <option>Plus récent</option>
          <option>Moins récent</option>
          <option>Auteur A-Z</option>
          <option>Auteur Z-A</option>        
        </select>
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
    <div class="panel border-black" style="margin-top:30px;">
      <div class="heading">
        <span class="title"><?= $value['title'] ?></span>
        <span class ="date place-right text-secondary padding-right10"><span class="mif-calendar mif-lg"></span> <?= $value['date_creation'] ?></span><br>
      </div>
      <div class="content">
        <div class="post_info text-small">
          <span class ="commentaires"><span class="mif-bubble fg-cobalt"></span> <?= $value['nbr_comments'] ?></span><br>
          <span class ="categories"><span class="mif-tag fg-cobalt"></span> <?= $value['categories'] ?></span><br>
        </div>
        <p><?= $value['summary'] ?></p><br>
        <span class ="author text-small"><span class="mif-user"></span> <?= $value['author'] ?></span>
      </div>
    </div>
  <?php
      }
    }
    ?>

    <div class="pagination">
      <?php
      if(isset($_GET['p']) && count($_GET)>0){
        $options = "";
          foreach ($_GET as $key => $value) {
            if($key != "p")
              $options .= "&".$key."=".$value;
          }
        }
      if(isset($_GET['p']) && $_GET['p'] > 1){
        
        
        echo "<a class=\"item\" href=\"?p=".($_GET['p']-1).$options."\"><</a>";
      }else{
        echo "<span class=\"item\" ><</span>";
      }

      if($nbrPages == 0){
        echo "<span class=\"item current\">1</span>";
      }
      else{        
         for($i=1; $i<=($nbrPages); $i++){
            echo "<a class=\"item\" href=\"?p=".$i.$options."\">".$i."</a>";
        }
      }     
    
    if(isset($_GET['p']) && $_GET['p'] < $nbrPages){        
        echo "<a class=\"item\" href=\"?p=".($_GET['p']+1).$options."\">></a>";
      }else{
        echo "<span class=\"item\" >></span>";
      }
?>

  </div>
</div>
