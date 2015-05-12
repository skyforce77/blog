<div>
	<br>
	<br>
	<div class="container page-content bg-white login-form">
		<?php if(isset($_SESSION['editor_id'])): ?>
			<br>
			<h1 class="text-light">Panel</h1>
			<hr class="bg-grayLighter">
			<br>
		<?php else: ?>
			<br>
			<h1 class="text-light">Vous devez être connecté</h1>
			<hr class="bg-grayLighter">
			<br>
		<?php endif ?>
	</div>
	<br>
	<br>
</div>