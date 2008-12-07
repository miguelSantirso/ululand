<h2 id="pageTitle" class="center"><?php echo __('Email account validation') ?></h2>
<div class="contentColumn wide center alignCenter">
	<div class="contentBox light bordered">
		<h3 class=""><?php echo sprintf(__('We need to confirm that you are the owner of the email you provided (%s)'), $userEmail); ?></h3>
	</div>
</div>
<br/>
<div id="pageContent">
<!-- Long explanation -->
<div class="contentRow">
	<!-- Long Explanation -->
	<div class="contentColumn half alignLeft">
		<div class="contentBox">
			<h3 class="header large"><?php echo __('Have you lost your confirmation email?') ?></h3>
			<?php echo link_to(sprintf(__('Resend email to %s'), $userEmail),
						'sfGuardAuth/ResendApprovalEmail?userEmail='.$userEmail,
						array('class' => 'bigBox')); ?>
		</div>
		<div class="contentBox light">
			<h3 class="header"><?php echo __('We trust you, but...'); ?></h3>
			<p class="small">Ya, ya sabemos que te da mucha pereza tener que revisar tu correo electr&oacute;nico y hacer clic en un enlace, pero no tenemos otra opci&oacute;n. &iexcl;Tenemos que estar seguros de que nos das un email de verdad y al que tienes acceso!</p>
			<p>Es importante porque...</p>
			<ul class="small">
				<li>Evitamos registros falsos.</li>
				<li>Reducimos el posible spam.</li>
				<li>Nos aseguramos de que puedas recuperar tu contraseña si la pierdes.</li>
				<li>Solo si t&uacute; quieres, podemos enviarte avisos de las &uacute;ltimas novedades en <strong>ulu</strong>land.</li>
			</ul>
			<p>Sigue las instrucciones de la derecha y valida tu email <em>en un plis</em>.</p>
		</div>
	</div>
	
	<!-- Step By Step instructions -->
	<div class="contentColumn half alignLeft">
		<div class="contentBox bordered">
			<h3 class="header large">Pasos a seguir:</h3>
			<div class="normalBox normal">
				<h4 class="header"><span class="xLarge">1. </span> <?php echo __('Check your email inbox'); ?></h4>
				<p class="small">Busca el correo que te enviamos hace una semana confirmando tu registro. En &eacute;l encontrar&aacute;s el <strong>enlace de confirmaci&oacute;n</strong></p>
				<?php if(isset($emailProvider)) : ?>
					<?php echo link_to(sprintf(__('Go to %s'), $emailProvider), "http://{$emailProvider}", array('class'=>'large bigBox', 'target' => '_blank')); ?>
				<?php endif; ?>
			</div>
			<div class="normalBox normal">
				<h4 class="header"><span class="xLarge">2. </span> <?php echo __('Click on the confirmation URL'); ?></h4>
				<p class="small">Pulsa en el enlace que has encontrado en el correo de confirmaci&oacute;n de registro.</p>
			</div>
			<div class="normalBox normal">
				<h4 class="header"><span class="xLarge">3. </span> <?php echo __('Close this window'); ?></h4>
				<p class="small">Una vez hayas completado el proceso, puedes cerrar esta ventana.</p>
			</div>
		</div>
	</div>
</div>
</div>