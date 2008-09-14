<?php use_helper('Partial', 'Tags'); ?>

<div id="pageContent">

	<?php if(isset($tag)) : ?>
		<div class="contentColumn half alignCenter">
			<div class="light contentBox">
				<p class="noSpace center"><?php echo sprintf(__('Showing collaboration offers tagged with %1$s (%2$s)'), link_to($tag, 'collaboration/list?tag='.$tag), link_to('show all', 'collaboration/list')); ?></p>
			</div>
		</div>
	<?php endif; ?>
	<?php if(isset($search)) : ?>
		<div class="contentColumn half alignCenter">
			<div class="contentBox light">
				<p class="noSpace center"><?php echo sprintf(__('Search results for %1$s (%2$s)'), link_to($search, 'collaboration/list?search='.$search), link_to('clear', 'collaboration/list')); ?></p>
			</div>
		</div>
	<?php endif; ?>
	
	<div class="contentColumn wide alignLeft">
		<?php if(isset($userFiltered)) : ?>
		<h4 class="header"><?php echo sprintf(__('Showing collaboration offers submitted by %1$s (%2$s)'), linkToProfile($userFiltered), link_to('clear', 'collaboration/list')); ?></h4>
		<?php endif; ?>
		
		<?php include_component('collaboration', 'list'); ?>
		
		<?php if($sf_user->isAuthenticated()) : ?>
			<?php echo link_to(__('Submit your own &raquo;'), 'collaboration/create', array('class' => 'button')); ?>
		<?php else :  ?>
			<p class="center">
				(<?php echo sprintf(__('requires %s or %s'), link_to(__('log in'), '@sf_guard_signin'), link_to(__('register'), '@register')) ?>)
				<?php echo link_to(__('Submit your own &raquo;'), 'collaboration/create', array('class' => '')); ?> 
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