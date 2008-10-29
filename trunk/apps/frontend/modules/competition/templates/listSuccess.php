<?php use_helper('Partial'); ?>

<h2 id="pageTitle"><?php echo link_to(image_tag("iconCompetitions.png").__('Competitions'), '/competition/list'); ?></h2>

<div id="pageContent">

	<?php if(isset($search)) : ?>
		<div class="contentColumn half alignCenter">
			<div class="contentBox light">
				<p class="noSpace center"><?php echo sprintf(__('Search results for %1$s (%2$s)'), link_to($search, 'competition/list?search='.$search), link_to('clear', 'competition/list')); ?></p>
			</div>
		</div>
	<?php endif; ?>
	
	<div class="contentColumn quarter alignLeft">
		
		<?php include_partial('searchForm', array('search' => isset($search) ? $search : null)); ?>
		
	</div>
	
	<div class="contentColumn wide alignRight">

		<?php include_component('competition', 'list'); ?>
		
	</div>
	
</div>
