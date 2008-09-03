<?php use_helper('PagerNavigation', 'Partial'); ?>

<div id="pageContent">

	<div class="contentColumn wide alignLeft">
		<?php if(isset($search)) : ?>
			<h3 class="header"><?php echo sprintf(__('Players whose name is similar to %1$s (%2$s)'), link_to($search, 'profile/list?search='.$search), link_to('show all', 'profile/list')); ?></h3>
		<?php endif; ?>
			
		<?php include_component('profile', 'list'); ?>		

	</div>
	
	
	<div class="contentColumn quarter alignRight">
	<?php if($sf_user->isAuthenticated() && !$sf_user->getProfile()->isFilledIn()) { ?>
		<div class="contentBox light">
			<h4 class="header small"><?php echo link_to(__("Fill in your profile now!"), 'profile/edit?id='.$sf_user->getProfile()->getId()); ?></h4>
			<p class="small"><?php echo __("Your profile is not filled in and you will not be listed here."); ?></p>
			<p class=""><?php echo link_to(__("Fill in your profile &raquo;"), 'profile/edit?id='.$sf_user->getProfile()->getId()); ?></p>
		</div>
	<?php } ?>
		<div class="">
			<?php include_partial('searchForm', array('search' => isset($search) ? $search : null)); ?>
		</div>
	</div>

</div>
