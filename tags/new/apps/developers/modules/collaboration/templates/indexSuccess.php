<?php use_helper('Partial'); ?>

<div id="pageHeader">
	<h2><?php echo link_to(__("The Kollaborator!"), '/collaboration'); ?></h2>
	<p class="subtitle"><?php echo __("Colaborative work is great, isn't it?"); ?></p>
</div>

<div id="pageContent">

	<div class="contentRow">
		<h3 class="header center"><?php echo __('The Kollaborator is a tool that helps flash game developers to work together.'); ?></h3>
		
		<div class="contentColumn half alignLeft">
			<div class="contentBox bordered">
				<h4 class="header center noSpace"><?php echo __('Looking for a project to work on?'); ?></h4>
					<?php if($sf_user->isAuthenticated()) : ?>
						<?php if($sf_user->getProfile()->getDeveloperProfile()->getIsFree()) : ?>
							<p class="center"><strong><?php echo __('You are already listed as collaborator, so...'); ?></strong></p>
						<?php else : ?>
							<p class="center"><strong><?php echo sprintf(__('%s to set that you are looking for a project and...'),
							link_to(__('Edit your profile'), 'profile/edit?id='.$sf_user->getProfile()->getId()) ); ?></strong></p>
						<?php endif; ?>
					<?php else : ?>
						<p class="center"><strong><?php echo sprintf(__('You must %1$s to appear in the collaborators list and...'),
							link_to(__('register'), '@register') ); ?></strong></p>
					<?php endif; ?>
					
					<p class="center"><strong><?php echo __('Try to search in the existing collaboration offers:') ?></strong></p>
					<?php echo include_partial('collaboration/tagCloud', array('listStyle' => 'cloud small', 'title' => '')); ?>
					<div style="clear:both"></div>
			</div>
		</div>
		
		<div class="contentColumn half alignLeft">
			<div class="contentBox bordered">
				<h4 class="header center noSpace"><?php echo __('Looking for collaborators?'); ?></h4>
					<?php if($sf_user->isAuthenticated()) : ?>
						<p class="center"><strong><?php echo link_to(__('Submit your own collaboration offer'), 'collaboration/create'); ?>, or...</strong></p>
					<?php else : ?>
						<p class="center"><strong><?php echo sprintf(__('%1$s or %2$s to submit your own collaboration offer'),
							link_to(__('Login'), '@sf_guard_signin', array('class' => '')),
							link_to(__('Register'), '@register') ); ?></strong></p>
					<?php endif; ?>
					
					<p class="center"><strong><?php echo __('Try to find someone in the collaborators list:') ?></strong></p>
					<?php echo include_partial('profile/tagCloud', array('listStyle' => 'cloud small', 'title' => '')); ?>
					<div style="clear:both"></div>
			</div>
		</div>
		<div style="clear:both"></div>
		
	</div>
	<br/>
	<div class="contentRow">
		
		<div class="contentColumn half alignLeft">
			<div class="contentBox">
				<h3 class="header">
					<?php echo link_to(__('Collaboration Offers'), 'collaboration/list'); ?> 
					<?php if($sf_user->isAuthenticated()) : ?>
						<?php echo '(' . link_to(__('submit your own') .')', 'collaboration/create', array('class' => '')); ?>
					<?php else : ?>
						<small>(<?php echo sprintf(__('%1$s or %2$s to submit'),
							link_to(__('login'), '@sf_guard_signin', array('class' => '')),
							link_to(__('register'), '@register') ); ?>)</small>
					<?php endif; ?>
				</h3>
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
				<h3 class="header">
					<?php echo __('Collaborators'); ?>
					<?php if(!$sf_user->isAuthenticated()) : ?>
						<small>(<?php echo sprintf(__('%1$s to appear here'),
							link_to(__('register'), '@register') ); ?>)</small>
					<?php endif; ?>
				</h3>
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
	
</div>