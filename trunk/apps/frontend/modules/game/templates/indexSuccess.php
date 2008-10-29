<?php use_helper('Partial'); ?>

<h2 id="pageTitle"><?php echo link_to(image_tag("iconGames.png").__('Games'), '/game'); ?></h2>

<div id="pageContent">

	<div class="contentColumn half alignLeft">
		<div class="contentBox bordered">
			<h3 class="header"><?php echo __('New Games') ?></h3>
			<?php include_component('game', 'list', array()) ?>
		</div>
	</div>

	<div class="contentColumn half alignLeft">
		<div class="contentBox bordered">
			<h3 class="header"><?php echo __('Recent Competitions') ?></h3>
			<?php include_component('competition', 'list', array()) ?>
		</div>
	</div>
</div>