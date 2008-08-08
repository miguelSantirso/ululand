<div id="pageHeader">
	<h2><?php echo link_to(__("The Kollaborator!"), '/collaboration'); ?></h2>
	<p class="subtitle"><?php echo __("Colaborative work is great, isn't it?"); ?></p>
</div>
<?php use_helper('Partial'); ?>
<div id="pageContent">
	<div class="fixedWidth half">
		<div class="contentBox bordered">
			<h3 class="header"><?php echo __('Latest Collaboration Offers'); ?></h3>
			<?php include_component('collaboration', 'list'); ?>
			<?php echo link_to(__('Create your own &raquo;'), 'collaboration/create', array('class' => 'button')); ?>
		</div>
	</div>
</div>