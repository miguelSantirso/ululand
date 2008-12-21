<?php use_helper('Validation'); ?>

<div id="pageContent">

	<div class="contentRow">
		<div class="contentColumn half alignLeft">
			<?php if(!$sf_user->isAuthenticated()) : ?>
			<br/>
			<?php echo image_tag($sf_user->getCulture().'/playersWelcome_blue.png', array('class' => 'alignCenter', 'alt' => 'Bienvenido a Ululand. El mejor sitio para jugar con tus amigos')) ?>
			<br/>
			<div class="center large" style="background: #8fceff; padding: 0.5em; -moz-border-radius: 5px;">
				<?php echo link_to(__('Register'), '@register'); ?> - 
				<?php echo link_to(__('Log in'), '@sf_guard_signin'); ?>
			</div>
			<?php else: ?>
				<div class="contentBox">
					<h3 class="header">
						<?php echo __('Your profile'); ?> <?php echo "(".linkToEditProfile(null, array(), __('edit')).")" ?>:
					</h3>
					
					<?php include_partial('profile/badge', array('profile' => $sf_user->getProfile()) ); ?>
					
					<div class="clearFloat"></div>
				</div>
			<?php endif; ?>
			
			<div class="contentBox bordered">
				<h3 class="header"><?php echo __('Latest ULUs (welcome!)') ?></h3>
				<?php include_component('profile', 'list', array('limit' => 4, 'getNewest' => true)) ?>
			</div>
		</div>
			
		<div class="contentColumn half alignLeft">
			<div class="contentBox bordered">
				<h3 class="header"><?php echo __('New Games') ?></h3>
				<?php include_component('game', 'list', array('limit' => 5, 'orderDescendingBy' => GamePeer::CREATED_AT)) ?>
			</div>
		</div>
		
	</div>

</div>
