<div id="pageHeader">
	<h2><?php echo link_to(__("The Kollaborator!"), '/collaboration'); ?></h2>
	<p class="subtitle"><?php echo __("Colaborative work is great, isn't it?"); ?></p>
</div>
<?php use_helper('Partial'); ?>
<div id="pageContent">

	<div class="fixedWidth half alignLeft">
		
		<div class="contentBox">
			<h3 class="header"><?php echo __('Collaboration Offers'); ?> (<?php echo link_to(__('show all'), 'collaboration/list') ?>)</h3>
			<p class="small"><?php echo __('Looking for a project to work on? Here you can find some projects in which you can collaborate.') ?></p>
			
			<div class="alignRight">
			<?php include_partial('searchForm', array('title' => '')); ?>
			</div>
			<h4>&nbsp;<?php echo __("Latest offers"); ?></h4>
			<?php include_component('collaboration', 'list'); ?>
			<?php if($sf_user->isAuthenticated()) : ?>
				<?php echo link_to(__('Submit your own &raquo;'), 'collaboration/create', array('class' => 'alignRight')); ?>
			<?php else :  ?>
				<p class="right">
					(<?php echo sprintf(__('requires %s or %s'), link_to(__('log in'), '@sf_guard_signin'), link_to(__('register'), '@register')) ?>)
					<?php echo link_to(__('Submit your own &raquo;'), 'collaboration/create', array('class' => '')); ?> 
				</p>
			<?php endif; ?>
			
			<div style="clear:both;"></div>
		</div>
		
	</div>
	
	<div class="fixedWidth half alignRight">
		
		<div class="contentBox">
			<h3 class="header"><?php echo __('Collaborators'); ?> (<?php echo link_to(__('show all'), 'profile/list') ?>)</h3>
			<p class="small"><?php echo __('Looking for someone to help you in your latest project? Here you can find some people that might want to help you.') ?></p>
			
			<div class="alignRight">
			<?php include_partial('profile/searchForm', array('title' => '')); ?>
			</div>
			<h4>&nbsp;<?php echo __("Recent collaborators"); ?></h4>
			<?php include_component('profile', 'list'); ?>
			
		</div>
		
	</div>
</div>