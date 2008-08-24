<?php use_helper('Javascript') ?>

<div id="pageContent">

	<div class="contentRow">
		<div class="alignCenter">
			<?php echo image_tag('welcome.png', array('class' => 'alignCenter', 'alt' => 'Flash Developers: ¡Bienvenidos! Esta es la red de desarrolladores de juegos flash de Ululand.com')); ?>
			<?php if(!$sf_user->isAuthenticated()) : ?>
			<div class="center large" style="background: #8fceff; padding: 0.5em; -moz-border-radius: 5px;">
				<?php echo link_to(__('Register'), '@register'); ?> - 
				<?php echo link_to(__('Log in'), '@sf_guard_signin'); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
	
	<br/>
	<br/>
	
	<div class="contentRow">
		
		<div class="contentColumn half alignLeft">
			<div class="contentBox">
				<h3 class="header"><?php echo sprintf(__('Latest posts from %s'), link_to(__('our blog'), 'http://blog.pncil.com/')); ?></h3>
				<div id="latestNews"><?php echo image_tag('ajax-loader.gif'); ?> <?php echo __('Loading...'); ?></div>
				<?php echo javascript_tag(
				  remote_function(array(
				    'update'  => 'latestNews',
				    'url'     => 'home/latestNews'
				  ))
				) ?>
			</div>
		</div>
		
		<div class="contentColumn half alignRight">
			<div class="contentBox bordered">
				<h3 class="header"><?php echo __('Quick Links'); ?></h3>
				<a href="<?php echo url_for('@wiki_home'); ?>" class="bigBox">
					<span class="large"><?php echo __('Flash Game Developers Wiki'); ?></span>
				</a>
				<a href="<?php echo url_for('recipe'); ?>" class="bigBox">
					<span class="large"><?php echo __('Flash Code Recipes'); ?></span>
				</a>
				<a href="<?php echo url_for('profile/list'); ?>" class="bigBox">
					<span class="large"><?php echo __('Registered People'); ?></span>
				</a>
				<a href="<?php echo url_for('collaboration/list'); ?>" class="bigBox">
					<span class="large"><?php echo __('Collaboration Offers'); ?></span>
				</a>
			</div>
		</div>
	</div>
	
</div>