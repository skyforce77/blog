<?php if(!empty($postResult)): ?>
			<script>
				$.Notify({
					caption: 'Commentaire',
					content: '<?= $postResult[1] ?>',
					type: '<?= $postResult[0] == 1 ? "alert" : "success" ?>',
					keepOpen: true,
					icon: "<span class='mif-user'></span>"
				});
			</script>
<?php endif ?>

<div class="container page-content">
	<br>
	<?php if($canEdit == 1): ?>
		    <div class="panel border-black">
						<div class="heading">
							<span class="title text-shadow">Créer un post</span>
				    	</div>
				    	<div class="content">
							<form action="#" method="POST">
								<div class="input-control text">
									<input type="text" name="title" placeholder="Titre" value="<?= $title ?>">
								</div>
								<br>
								<?php foreach ($categories as $categorie) { ?>
									<label class="switch">
										<p><?= $categorie->getName() ?>
											<input type="checkbox" name="<?= $categorie->getName() ?>">
											<span class="check"></span>
										</p>
									</label>
								<?php } ?>
								<br>
								<div class="input-control textarea commentaire-area">
									<textarea name="summary" placeholder="Résumé"><?= $summary ?></textarea>
								</div>
								<br>
								<div class="input-control textarea commentaire-area">
									<textarea name="content" placeholder="Contenu" ><?= $content ?></textarea>
								</div>
								<br>
								<input class="button" type="submit" value="Créer">
							</form>
						</div>
				    </div>
		    </div>
	<?php else: ?>
		<h3><span class="mif-warning fg-orange"></span> Vous ne pouvez pas voir ceci</h3>
	<?php endif ?>
</div>
