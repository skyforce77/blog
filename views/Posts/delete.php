<div class="container page-content">
	<br>
	<?php if(isset($post[0]) && $canEdit == 1): ?>
		    <div class="panel border-black">
						<div class="heading">
							<span class="title text-shadow">Tentative de supression</span>
				    	</div>
				    	<div class="content">
							<h3><span class="mif-warning fg-orange"></span> Suppression effectuée</h3>
						</div>
				    </div>
		    </div>
	<?php else: ?>
		<h3><span class="mif-warning fg-orange"></span> Vous ne pouvez pas effectuer cette action</h3>
	<?php endif ?>
</div>