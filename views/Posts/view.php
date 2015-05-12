<div class="container page-content">
	<br>
	<br>
	<?php if(isset($post[0])): ?>
		    <div class="panel border-black">
				<div class="heading">
					<span class="title text-shadow"><?= $post[0]['title'] ?></span>
					<span class ="date place-right text-secondary padding-right10"><span class="mif-calendar mif-lg"></span> <?= $post[0]['date_creation'] ?></span><br>
		    	</div>
		    	<div class="content">
				<div class="post_info text-small">
			  <span class ="commentaires"><span class="mif-bubble fg-cobalt"></span> <?= $post[0]['nbr_comments'] ?></span><br>
			  <span class ="categories"><span class="mif-tag fg-cobalt"></span> <?= $post[0]['categories'] ?></span><br>
			</div>
			<p><?= $post[0]['content'] ?></p><br>
			<span class ="author text-small"><span class="mif-user"></span> <?= $post[0]['author'] ?></span>
		      </div>
		    </div>
		    <br>

		    <div class="panel border-black">
				<div class="heading">
					<span class="title text-shadow">Commentaires</span>
		    	</div>
		    	<div class="content">
		    		<?php
      					if (count($comments) == 0){ ?>
					        <br>
					        <h4>Aucun commentaire</h4>
					<?php    } else {
					      foreach ($comments as $value) {
					 ?>
					    <div class="panel border-black">
							<div class="heading">
								<span class="title"><?= $value['autor'] ?></span>
								<span class ="date place-right text-secondary padding-right10"><span class="mif-calendar mif-lg"></span> <?= $value['date_creation'] ?></span><br>
					    	</div>
					    	<div class="content">
						        <p>> <?= $value['content'] ?></p><br>
							</div>
					    </div>
					    <br>
					<?php
					      }
					    }
					?>
				</div>
		    </div>
		    <br>

		    <div class="panel border-black">
						<div class="heading">
							<span class="title text-shadow">Poster un commentaire</span>
				    	</div>
				    	<div class="content">
							<form action="#" method="POST">
								<div class="input-control text">
									<input type="text" name="mail" placeholder="Adresse mail">
								</div>
								<div class="input-control text">
									<input type="text" name="pseudo" placeholder="Pseudonyme">
								</div>
								<br>
								<div class="input-control textarea commentaire-area">
									<textarea name="text" placeholder="Commentaire"></textarea>
								</div>
								<br>
								<input class="button" type="submit" value="Poster">
							</form>
						</div>
				    </div>
		    </div>
	<?php else: ?>
		<h3><span class="mif-warning fg-orange"></span> Post inexistant</h3>
	<?php endif ?>
</div>
