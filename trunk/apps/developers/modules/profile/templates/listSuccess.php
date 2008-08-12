<?php use_helper('PagerNavigation', 'Partial', 'Tags') ?>

<div id="pageHeader">
	<h2><?php echo link_to(__("Registered people"), 'profile/list'); ?></h2>
	<p class="subtitle"><?php echo __("We create games!"); ?></p>
</div>

<div id="pageContent">
	
	<?php if(isset($tag)) : ?>
		<div class="contentBox light fixedWidth half alignCenter">
			<p class="noSpace center"><?php echo sprintf(__('Showing developers tagged with %1$s (%2$s)'), link_to($tag, 'profile/list?tag='.$tag), link_to('show all', 'profile/list')); ?></p>
		</div>
	<?php endif; ?>
		
	<div class="fixedWidth wide alignLeft">
		<?php if(isset($search)) : ?>
			<h3 class="header"><?php echo sprintf(__('Developers whose name is similar to %1$s (%2$s)'), link_to($search, 'profile/list?search='.$search), link_to('show all', 'profile/list')); ?></h3>
		<?php endif; ?>
			
		<?php include_component('profile', 'list'); ?>		

	</div>
	
	<div class="fixedWidth third alignRight">
	<?php if($sf_user->isAuthenticated() && !$sf_user->getProfile()->isFilledIn()) { ?>
		<div class="contentBox light">
			<h3 class="header"><?php echo link_to(__("Fill in your profile now!"), 'profile/edit?id='.$sf_user->getProfile()->getId()); ?></h3>
			<p class=""><?php echo __("Your profile is not filled in and you will not be listed here."); ?></p>
			<p class=""><?php echo link_to(__("Fill in your profile &raquo;"), 'profile/edit?id='.$sf_user->getProfile()->getId()); ?></p>
		</div>
	<?php } ?>
		<div class="">
			<?php include_partial('searchForm'); ?>
		</div>
		<div class="">
			<?php include_partial('tagCloud') ?>
		</div>
	</div>
</div>