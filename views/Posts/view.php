<?php if(!empty($postResult)): ?>
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

	<?php if(!empty($post->getId())): ?>
		    <div class="panel border-black">
				<div class="heading">
					<span class="title text-shadow"><?= $post->getTitle() ?></span>
					<span class ="date place-right text-secondary padding-right10"><span class="mif-calendar mif-lg"></span> <?= $post->getDateCreation() ?></span><br>
		    	</div>
		    	<div class="content">
				<div class="post_info text-small">
			  <span class ="commentaires"><span class="mif-bubble fg-cobalt"></span> <?= $post->getTitle() ?></span><br>
			  <span class ="categories"><span class="mif-tag fg-cobalt"></span> <?= $post->getCategories() ?></span><br>
			</div>
				<p style="word-wrap: break-word;"><?= $post->getContent() ?></p><br>
				<?php if($canEdit == 1): ?>
					<?= html::link('<span class="mif-pencil"></span> Editer', array('controller'=>'Posts', 'view'=>'edit', 'params'=>$post->getId()), array('class'=>'button')) ?>
					<?= html::link('<span class="mif-bin"></span> Supprimer', array('controller'=>'Posts', 'view'=>'delete', 'params'=>$post->getId()), array('class'=>'button')) ?>
				<?php else: ?>
					<?= html::link('<span class ="author text-small"><span class="mif-user"></span> '.$user->getName(), array('controller'=>'Editors', 'view'=>'profil', 'params'=>$user->getId())) ?>
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
							<p style="word-wrap: break-word;"><?= $value->getContent() ?></p>
							<small>
								Par <strong><?= $value->getAuthor() ?></strong> le <?= $value->getDateCreation() ?>
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
							<form action="" method="POST">
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
