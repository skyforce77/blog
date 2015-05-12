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
			<span class ="author text-small"><span class="mif-user"></span> <?= $post[0]['autor'] ?></span>
		      </div>
		    </div>
	<?php else: ?>
		<h3><span class="mif-warning fg-orange"></span> Post inexistant</h3>
	<?php endif ?>
</div>
