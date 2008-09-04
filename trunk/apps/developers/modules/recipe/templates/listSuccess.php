<?php use_helper('Partial', 'Tags'); ?>

<div id="pageContent">

	<?php if(isset($tag)) : ?>
		<div class="contentColumn half alignCenter">
			<div class="light contentBox">
				<p class="noSpace center"><?php echo sprintf(__('Showing recipes tagged with %1$s (%2$s)'), link_to($tag, 'recipe/list?tag='.$tag), link_to('show all', 'recipe/list')); ?></p>
			</div>
		</div>
	<?php endif; ?>
	<?php if(isset($search)) : ?>
		<div class="contentColumn half alignCenter">
			<div class="contentBox light">
				<p class="noSpace center"><?php echo sprintf(__('Search results for %1$s (%2$s)'), link_to($search, 'recipe/list?search='.$search), link_to('clear', 'recipe/list')); ?></p>
			</div>
		</div>
	<?php endif; ?>
	
	<div class="contentColumn wide alignLeft">

		<?php include_component('recipe', 'list'); ?>
		
		<?php if($sf_user->isAuthenticated()) : ?>
			<?php echo link_to(__('Submit your own &raquo;'), 'recipe/create', array('class' => 'button')); ?>
		<?php else :  ?>
			<p class="center">
				(<?php echo sprintf(__('requires %s or %s'), link_to(__('log in'), '@sf_guard_signin'), link_to(__('register'), '@register')) ?>)
				<?php echo link_to(__('Submit your own &raquo;'), 'recipe/create', array('class' => '')); ?> 
			</p>
		<?php endif; ?>
	</div>
	
	<div class="contentColumn quarter alignRight">
		
		<?php include_partial('searchForm', array('search' => isset($search) ? $search : null)); ?>
		
		<div class="">
			<?php include_partial('tagCloud'); ?>
		</div>
	</div>
	
</div>