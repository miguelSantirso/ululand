<div id="pageHeader">
	<h2><?php echo link_to(__("The Kollaborator!"), '/collaboration'); ?></h2>
	<p class="subtitle"><?php echo __("Colaborative work is great, isn't it?"); ?></p>
</div>
<?php use_helper('Partial'); ?>
<div id="pageContent">

	<div class="contentColumn half alignLeft">
		
		<div class="contentBox">
			<h3 class="header"><?php echo __('Collaboration Offers'); ?> <?php if($sf_user->isAuthenticated()) echo '(' . link_to(__('submit your own') .')', 'collaboration/create', array('class' => '')); ?></h3>
			<p class="small"><?php echo __('Looking for a project to work on? Here you can find some projects in which you can collaborate.') ?></p>
			
			<div class="alignRight">
			<?php include_partial('searchForm', array('title' => '')); ?>
			</div>
			<h4>&nbsp;<?php echo __("Latest offers"); ?></h4>
			<?php include_component('collaboration', 'list'); ?>
			<p class="right"><?php echo link_to(__('Show full list &raquo;'), 'collaboration/list') ?></p>
			
			<div style="clear:both;"></div>
		</div>
		
	</div>
	
	<div class="contentColumn half alignRight">
		
		<div class="contentBox">
			<h3 class="header"><?php echo __('Collaborators'); ?></h3>
			<p class="small"><?php echo __('Looking for someone to help you in your latest project? Here you can find some people that might want to help you.') ?></p>
			
			<div class="alignRight">
			<?php include_partial('profile/searchForm', array('title' => '', 'onlyFree' => true)); ?>
			</div>
			<h4>&nbsp;<?php echo __("Recent collaborators"); ?></h4>
			<?php include_component('profile', 'list', array('onlyFree' => true)); ?>
			<p class="right"><?php echo link_to(__('Show full list &raquo;'), 'profile/list') ?></p>
		</div>
		
	</div>
</div>