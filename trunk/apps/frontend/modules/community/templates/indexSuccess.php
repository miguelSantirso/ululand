<?php use_helper('Partial'); ?>

<div id="pageContent">

	<div class="contentColumn half alignLeft">
		<div class="contentBox bordered">
			<h3 class="header"><?php echo __('New Players') ?></h3>
			<?php include_component('profile', 'list', array()) ?>
			
			<?php echo link_to(__('See full list').' &raquo;', 'profile/list'); ?>
		</div>
	</div>

	<div class="contentColumn half alignLeft">
		<div class="contentBox bordered">
			<h3 class="header"><?php echo __('Recent Groups') ?></h3>
			<?php include_component('group', 'list', array()) ?>
			
			<?php echo link_to(__('See full list'.' &raquo;'), 'group/list'); ?>
			<?php if($sf_user->isAuthenticated()) : ?>
			<br/>
			<br/>
			<?php echo link_to(__('Create your own group'), 'group/create', array('class' => 'bigBox')); ?>
			<?php endif; ?>
		</div>
	</div>
</div>