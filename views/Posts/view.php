<?php if($postResult != null): ?>
			<script>
				$.Notify({
					caption: 'Commentaire',
					content: '<?= 
$postResult[1] ?>',
					type: '<?= 
$postResult[0] == 1 ? "alert" : "success" ?>',
					keepOpen: true,
					icon: "<span class='mif-user'></span>"
				});
			</script>
<?php endif ?>

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
				<?php if($canEdit == 1): ?>
					<?= html::link('<span class="mif-pencil"></span> Editer votre article', array('controller'=>'Posts', 'view'=>'edit', 'params'=>$post[0]['id']), array('class'=>'button')) ?>
				<?php else: ?>
					<span class ="author text-small"><span class="mif-user"></span> <?= $post[0]['author'] ?></span>
				<?php endif ?>
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
					    <blockquote>
							<p><?= htmlspecialchars($value['content']) ?></p>
							<small>
								Par <strong><?= htmlspecialchars($value['author']) ?></strong> le <?= $value['date_creation'] ?>
							</small>
						</blockquote>
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
									<?php if($postResult != null && $postResult[0] == 1): ?>
										<input type="text" name="mail" placeholder="Adresse mail" value="<?= $_POST['mail'] ?>">
									<?php else: ?>
										<input type="text" name="mail" placeholder="Adresse mail">
									<?php endif ?>
								</div>
								<div class="input-control text">
									<?php if($postResult != null && $postResult[0] == 1): ?>
										<input type="text" name="pseudo" placeholder="Pseudonyme" value="<?= $_POST['pseudo'] ?>">
									<?php else: ?>
										<input type="text" name="pseudo" placeholder="Pseudonyme">
									<?php endif ?>
								</div>
								<br>
								<div class="input-control textarea commentaire-area">
									<?php if($postResult != null && $postResult[0] == 1): ?>
										<textarea name="text" placeholder="Commentaire"><?= $_POST['text'] ?></textarea>
									<?php else: ?>
										<textarea name="text" placeholder="Commentaire"></textarea>
									<?php endif ?>
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
