<?php use_helper('Partial'); ?>

<h2 id="pageTitle"><?php echo link_to(image_tag("iconGames.png").__('Games List'), '/game/list'); ?></h2>

<div id="pageContent">

	<?php if(isset($tag)) : ?>
		<div class="contentColumn half alignCenter">
			<div class="light contentBox">
				<p class="noSpace center"><?php echo sprintf(__('Showing games tagged with %1$s (%2$s)'), link_to($tag, 'game/list?tag='.$tag), link_to('show all', 'game/list')); ?></p>
			</div>
		</div>
	<?php endif; ?>
	<?php if(isset($search)) : ?>
		<div class="contentColumn half alignCenter">
			<div class="contentBox light">
				<p class="noSpace center"><?php echo sprintf(__('Search results for %1$s (%2$s)'), link_to($search, 'game/list?search='.$search), link_to('clear', 'game/list')); ?></p>
			</div>
		</div>
	<?php endif; ?>
	
	<div class="contentColumn quarter alignLeft">
		<div class="">
			<?php include_partial('tagCloud'); ?>
		</div>
		<?php include_partial('searchForm', array('search' => isset($search) ? $search : null)); ?>
	</div>
	
	<div class="contentColumn wide alignLeft">
		<div class="contentBox">
			<?php include_component('game', 'list'); ?>
		</div>
	</div>
	
</div>