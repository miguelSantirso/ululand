<?php use_helper('Partial'); ?>

<div id="pageHeader">
	<h2><?php echo link_to(__("Collaboration offers list"), '/collaboration/list'); ?></h2>
	<p class="subtitle"><?php echo __("Colaborative work is great, isn't it?"); ?></p>
</div>

<div id="pageContent">

	<?php if(isset($tag)) : ?>
		<div class="contentBox light fixedWidth half alignCenter">
			<p class="noSpace center"><?php echo sprintf(__('Showing collaboration offers tagged with %1$s (%2$s)'), link_to($tag, 'collaboration/list?tag='.$tag), link_to('show all', 'collaboration/list')); ?></p>
		</div>
	<?php endif; ?>
	<?php if(isset($search)) : ?>
		<div class="contentBox light fixedWidth half alignCenter">
			<p class="noSpace center"><?php echo sprintf(__('Search results for %1$s (%2$s)'), link_to($search, 'collaboration/list?search='.$search), link_to('clear', 'collaboration/list')); ?></p>
		</div>
	<?php endif; ?>
	
	<div class="fixedWidth wide alignLeft">
		
		<?php include_component('collaboration', 'list'); ?>
		
		<?php echo link_to (__('Submit your own &raquo;'), 'collaboration/create', array('class' => 'alignRight')) ?>
	</div>
	
	<div class="fixedWidth third alignRight">

		<?php include_partial('searchForm'); ?>

	</div>
	
</div>