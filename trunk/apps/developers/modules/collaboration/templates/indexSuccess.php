<div id="pageHeader">
	<h2><?php echo link_to(__("The Kollaborator!"), '/collaboration'); ?></h2>
	<p class="subtitle"><?php echo __("Colaborative work is great, isn't it?"); ?></p>
</div>
<?php use_helper('Partial'); ?>
<div id="pageContent">

	<div class="fixedWidth half alignLeft">
		
		<div class="contentBox">
			<h3 class="header"><?php echo __('Latest Collaboration Offers'); ?> (<?php echo link_to(__('show all'), 'collaboration/list') ?>)</h3>
			
			<?php include_component('collaboration', 'list'); ?>
			<?php echo link_to(__('Submit your own &raquo;'), 'collaboration/create', array('class' => 'alignRight')); ?>
			
			<div class="contentBox alignRight">
			<?php include_partial('searchForm', array('title' => '')); ?>
			</div>
			
		</div>
		
	</div>
	
	<div class="fixedWidth half alignRight">
		
		<div class="contentBox">
			<h3 class="header"><?php echo __('Latest Collaborators'); ?> (<?php echo link_to(__('show all'), 'profile/list') ?>)</h3>
			
			<?php include_component('profile', 'list'); ?>
			
			<div class="contentBox alignRight">
			<?php include_partial('profile/searchForm', array('title' => '')); ?>
			</div>
			
		</div>
		
	</div>
</div>