<div class="contentColumn wide normalBox subtle">
	<h2 class="alignCenter">Necesitas validar tu email</h2>
	<p class="alignCenter">Busca el email de confirmaci&oacute;n en tu correo y sigue las instrucciones.</p>
</div>

<!-- Long explanation -->
<div class="contentColumn wide">
	<div class="contentColumn medium alignLeft">
		<div class="normalBox subtle">
			<h3 class="header large">Pasos a seguir:</h3>
			<div class="normalBox normal">
				<h4 class="header"><span class="xLarge">1. </span> Comprueba tu correo</h4>
				<p class="small">Busca el correo que te enviamos hace una semana confirmando tu registro. En &eacute;l encontrar&aacute;s el <strong>enlace de confirmaci&oacute;n</strong></p>
			</div>
			<div class="normalBox normal">
				<h4 class="header"><span class="xLarge">2. </span> Accede a la direcci&oacute;n de confirmaci&oacute;n</h4>
				<p class="small">Pulsa en el enlace que has encontrado en el correo de confirmaci&oacute;n de registro.</p>
			</div>
			<div class="normalBox normal">
				<h4 class="header"><span class="xLarge">3. </span> Cierra esta ventana</h4>
				<p class="small">Una vez hayas completado el proceso, puedes cerrar esta ventana.</p>
			</div>
		</div>
	</div>
	
	<!-- Step By Step instructions -->
	<div class="contentColumn medium alignRight">
		<div class="normalBox subtle">
			<h3 class="header large">&iquest;No encuentras el email?</h3>
			<?php echo link_to('Reenviar email a <strong>'.$userEmail.'</strong> &raquo;', 'home/ResendApprovalEmail?userEmail='.$userEmail, array('class' => 'navigation')) ?>
		</div>
		<div class="normalBox subtle">
			<h3 class="header">Nos fiamos de ti, pero...</h3>
			<p class="small">Ya, ya sabemos que te da mucha pereza tener que revisar tu correo electr&oacute;nico y hacer clic en un enlace, pero no tenemos otra opci&oacute;n. &iexcl;Tenemos que estar seguros de que nos das un email de verdad y al que tienes acceso!</p>
			<p>Es importante porque...</p>
			<ul class="small">
				<li>Evitamos registros falsos.</li>
				<li>Reducimos el posible spam.</li>
				<li>Nos aseguramos de que puedas recuperar tu contraseña si la pierdes.</li>
				<li>Solo si t&uacute; quieres, podemos enviarte avisos de las &uacute;ltimas novedades en <strong>ulu</strong>land.</li>
			</ul>
			<p>Sigue las instrucciones de la izquierda y valida tu email <em>en un plis</em>.</p>
		</div>
	</div>
</div>
