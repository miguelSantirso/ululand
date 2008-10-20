<?php use_helper('Partial'); ?>

<div id="pageContent">

	<?php if(isset($search)) : ?>
		<div class="contentColumn half alignCenter">
			<div class="contentBox light">
				<p class="noSpace center"><?php echo sprintf(__('Search results for %1$s (%2$s)'), link_to($search, 'group/list?search='.$search), link_to('clear', 'group/list')); ?></p>
			</div>
		</div>
	<?php endif; ?>
	
	<div class="contentColumn wide alignLeft">

		<?php include_component('group', 'list'); ?>
		
	</div>
	
	<div class="contentColumn quarter alignRight">
		
		<?php include_partial('searchForm', array('search' => isset($search) ? $search : null)); ?>
		
		<?php if($sf_user->isAuthenticated()) : ?>
			<?php echo link_to(__('Create your own group'), 'group/edit', array('class' => 'bigBox')); ?>
		<?php else :  ?>
			<p class="center">
				(<?php echo sprintf(__('requires %s or %s'), link_to(__('log in'), '@sf_guard_signin'), link_to(__('register'), '@register')) ?>)
				<?php echo link_to(__('Create your own &raquo;'), 'group/edit', array('class' => '')); ?> 
			</p>
		<?php endif; ?>
		
	</div>
	
</div>
