<?php use_helper('Javascript', 'ulLinks', 'Partial') ?>

<div id="pageContent">

	<div class="contentRow">
		<div class="contentColumn half alignLeft">
			<?php if(!$sf_user->isAuthenticated()) : ?>
			<br/>
			<?php echo image_tag($sf_user->getCulture().'/developersWelcome.png', array('class' => 'alignCenter', 'alt' => 'Bienvenido a la comunidad 2.0 de desarrolladores de juegos flash.')); ?>
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
				<h3 class="header"><?php echo __('Subscribe to our Google Group'); ?></h3>
				<p><?php echo sprintf(
					__('Suscribe to our %s to keep up to date with the latest news about Ululand and to discuss about flash games development.'), 
					link_to(__('Ululand\'s Group in Google'), 'http://groups.google.com/group/desarrolladores-ululand'));  ?>
				<!-- caja de suscripci�n a grupo de Google -->
				  <p><b><?php echo __('Subscribe to'); ?> <a href="http://groups.google.com/group/desarrolladores-ululand"><?php echo __('our group'); ?></a></b></p>
				  <form action="http://groups.google.com/group/desarrolladores-ululand/boxsubscribe">
				  Email: <input type=text name=email <?php if($sf_user->isAuthenticated()) : ?>value="<?php echo $sf_user->getUsername(); ?>"<?php endif; ?> />
				  <input type=submit name="sub" value="<?php echo __('Subscribe'); ?>" />
				  </form>
			</div>
			<?php endif; ?>
		</div>
			
		<div class="contentColumn half alignRight">
			<div class="contentBox bordered">
				<h3 class="header"><?php echo __('Quick Links'); ?></h3>
				<a href="<?php echo url_for('game'); ?>" class="bigBox">
					<span class="large"><?php echo __('Games'); ?></span>
				</a>
				<a href="<?php echo url_for('recipe'); ?>" class="bigBox">
					<span class="large"><?php echo __('Flash Code Recipes'); ?></span>
				</a>
				<a href="<?php echo url_for('@wiki_home'); ?>" class="bigBox">
					<span class="large"><?php echo __('Flash Game Developers Wiki'); ?></span>
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
		
		<div class="contentColumn half alignLeft">
			<div class="contentBox">
				<h3 class="header"><?php echo link_to(__('Latest Developers'), 'profile/list'); ?> <?php echo __('(welcome!)') ?></h3>
				<?php echo include_component('profile', 'list', array('limit' => 4, 'orderDescendingBy' => sfGuardUserPeer::CREATED_AT)) ?>
			</div>
		</div>
	
	</div>
	
</div>