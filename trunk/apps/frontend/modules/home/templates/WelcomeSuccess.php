<?php use_helper('Validation'); ?>

<div id="pageContent">

	<div class="contentRow">
		<div class="contentColumn half alignLeft">
			<?php if(!$sf_user->isAuthenticated()) : ?>
			<br/>
			<?php echo image_tag('bienvenido.png', array('alt' => 'Bienvenido a Ululand')) ?>
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
		</div>
			
		<div class="contentColumn half alignRight">
			<div class="contentBox bordered">
				<h3 class="header"><?php echo __('Quick Links'); ?></h3>
				<a href="<?php echo url_for('profile/list'); ?>" class="bigBox">
					<span class="large"><?php echo __('Registered People'); ?></span>
				</a>
				<a href="<?php echo url_for('game/list'); ?>" class="bigBox">
					<span class="large"><?php echo __('Games'); ?></span>
				</a>
				<a href="<?php echo url_for('group/list'); ?>" class="bigBox">
					<span class="large"><?php echo __('Groups'); ?></span>
				</a>
			</div>
		</div>
		
	</div>

</div>
	<!-- 
	
	<?php if( !$sf_user->isAuthenticated() ): ?>
		<div class="contentColumn medium alignRight">
			<div class="normalBox subtle">
				<h3 class="alignCenter">&iexcl;<strong>ulu</strong>land es solo para socios!</h3>
				<p class="small">Lo bueno es que <strong>cualquiera</strong> puede ser socio de <strong>ulu</strong>land. Y gratis. Y en cualquier momento. De hecho, si todav&iacute;a no eres socio de Ululand, podr&iacute;as serlo en un minuto.</p>
				<p><?php echo link_to('Hazte socio de <strong>ulu</strong>land', '@register', array('class' => 'navigation')) ?></p>
			</div>
			<div class="normalBox subtle">
				<h3 class="alignCenter">Eh, eh. Que yo ya soy socio, amigo.</h3>
				<h4>Disculpe, se&ntilde;or. No le recordaba.</h4>
				<p class="small">Perd&oacute;n. Normalmente nos acordamos de nuestros socios pero bueno, no pasa nada. Quiz&aacute;s lleves tiempo sin venir o te est&eacute;s conectando desde un ordenador diferente.</p>
				<p><?php echo link_to('Identif&iacute;cate en <strong>ulu</strong>land', '@sf_guard_signin', array('class' => 'navigation')) ?></p>
			</div>
		</div>
		 <div class="contentColumn medium">
		 	<?php echo image_tag('bienvenido.png', array('alt' => 'Bienvenido a Ululand')) ?>
		 </div>
		 
	<?php else: ?>
		<?php if($avatar) : ?>
		<div class="contentColumn medium alignRight">
			<div class="normalBox normal">
				<h3 class="header">Desde los foros...</h3>
				<?php use_helper('Partial'); ?>
				<div class="small">
					<?php //include_component('sfSimpleForum', 'latestPosts') ?>
				</div>
			</div>
		</div>
		<div class="contentColumn medium alignLeft">
				<div class="alignLeft">
				<?php include_component('widget', 'widget', array('widgetName' => 'UlulandAvatarRepresentator', 
																'width' => '100px', 'height' => '150px',
																'flashVars' => 'sizeStretch=0.6&avatarApiKeys='.$avatar->getApiKey() )); ?>
				</div>
			<div class="normalBox subtle">
				<h3 class="">&iexcl;Hola <?php echo $avatar->getProfileLink(); ?>!</h3>
				<h4>Bienvenido de nuevo a <strong>ulu</strong>land.</h4>
				<p class="small">Tienes <?php echo $avatar->getAvailableCredits(); ?> cr&eacute;ditos disponibles.</p>
				<?php
					$notConfirmedFriendsNumber = count($avatar->getNotConfirmedFriends());
					if($notConfirmedFriendsNumber > 0) {
				?>
					<p class="small normalEmphasis">Tienes <?php echo link_to(count($avatar->getNotConfirmedFriends()) . ' peticiones de amistad pendientes', 'profile/show?id='.$avatar->getId()) ?>.</p>
				<?php } ?>
				<?php echo link_to('Ir a mi habitaci&oacute;n &raquo;', 'profile/show?id='.$avatar->getId(), array('class' => 'navigation', 'style' => 'margin-left: 93px')) ?>
			</div>
			<div class="normalBox subtle">
				<h3 class="header alignCenter">La gu&iacute;a de actividades.</h3>
				<h4>Aqu&iacute; nadie se aburre. Nunca.</h4>
				<p class="small">Porque hay montones de cosas que hacer. Elige y disfruta:</p>
				<ul>
					<li><?php echo link_to("Sala de m&aacute;quinas", "game"); ?></li>
				    <li><?php echo link_to("Habitaciones", "profile"); ?></li>
				    <li><?php echo link_to("Tienda de ropa", "home/EditAvatar"); ?></li>
				</ul>
			</div>
		</div>
		<?php endif; ?>
	<?php endif; ?>
	
	 -->