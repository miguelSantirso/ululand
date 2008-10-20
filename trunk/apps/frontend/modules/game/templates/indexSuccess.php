<?php use_helper('Partial'); ?>

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