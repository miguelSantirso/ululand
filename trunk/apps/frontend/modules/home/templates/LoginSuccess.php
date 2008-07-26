<?php use_helper('Validation'); ?>
	<div class="fixedWidth wide normalBox subtle">
		<h2 class="alignCenter">Iniciar sesi&oacute;n</h2>
		<p class="alignCenter">Necesitas iniciar sesi&oacute;n para utilizar <strong>ulu</strong>land</p>
	</div>
	
<!-- login form -->
<div class="fixedWidth medium alignLeft">
	<?php echo form_tag('home/Login', array('class' => 'card')) ?>
	<fieldset class="labelsAtRight">
	<legend class="xLarge">Iniciar sesi&oacute;n</legend>
		<ol class="large">
			<li>
			  <?php echo form_error('email', array("class" => "small subtleEmphasis")) ?>
			  <?php echo label_for('email', 'E-Mail') ?>
			  <?php echo input_tag('email', null, array("class" => "large")) ?>
		  	</li>
		  	<li id="passwordField">
			  <?php echo form_error('password', array("class" => "small subtleEmphasis")) ?>
			  <?php echo label_for('password', 'Contrase&ntilde;a') ?>
			  <?php echo input_password_tag('password', null, array("class" => "large")) ?>
		  	</li>
		  	<li>
			  <?php echo label_for('recpassword[1]', 'Recu&eacute;rdame') ?>
			  <?php echo checkbox_tag('recpassword[1]', true, false, array("class" => "large")) ?>
			</li>
		  	<?php //echo link_to('Entrar como invitado', 'home/Login?email=guest') ?>
		</ol>
	<?php echo submit_tag('Iniciar sesi&oacute;n', array('class' => 'submit wide large')) ?>
	</fieldset>
	<?php if ($sfContext->getActionStack()->getFirstEntry()->getActionName() != 'Login' && $sfContext->getActionStack()->getFirstEntry()->getActionName() != 'Logout'): ?>
		<?php $referer = $sf_params->get('referer') ? $sf_params->get('referer') : $sf_request->getUri(); ?>
	    <?php echo input_hidden_tag('referer', $referer) ?>    
	<?php endif ?>
	</form>
</div>

<!-- Go to register box -->
<div class="fixedWidth medium alignRight">
	<div class="normalBox subtle">
		<h3 class="alignCenter">&iexcl;<strong>ulu</strong>land es solo para socios!</h3>
		<p class="small">Lo bueno es que <strong>cualquiera</strong> puede ser socio de <strong>ulu</strong>land. Y gratis. Y en cualquier momento. De hecho, si todav&iacute;a no eres socio de ululand, podr&iacute;as serlo en un minuto.</p>
		<p><?php echo link_to('Hazte socio de <strong>ulu</strong>land &raquo;', 'home/Register', array('class' => 'navigation')) ?></p>
	</div>
</div>

<?php use_helper('Tooltip'); ?>
<?php echo tooltip_script('email', 'Debes introducir la direcci&oacute;n de email que nos diste al registrarte.<br/>&iquest;A&uacute;n no tienes cuenta en Ululand?<br/>' . link_to('&iexcl;Reg&iacute;strate en medio minuto!', 'home/Register'), 'creamy', 'width: 250, hook: {target: "topRight", tip: "topLeft"}, stem: "leftTop", showOn: "focus", hideOn: "blur", title: "Direcci&oacute;n de E-Mail"'); ?>
<?php echo tooltip_script('password', 'Debes introducir la contrase&ntilde;a que elegiste al registrarte. Si la has olvidado, debes ponerte en contacto con un administrador para poder recuperar la cuenta.', 'creamy', 'width: 250, hook: {target: "topRight", tip: "topLeft"}, stem: "leftTop", showOn: "focus", hideOn: "blur", title: "Contrase&ntilde;a"'); ?>
<?php echo tooltip_script('recpassword_1', 'Si quieres, podemos acordarnos de ti cada vez que entres a Ululand. De esta forma no tendr&aacute;s que iniciar sesi&oacute;n.<br/>Sin embargo, <strong>no actives nunca esta opci&oacute;n cuando navegues desde ordenadores p&uacute;blicos o de amigos</strong>. Si lo hicieras, cualquiera podr&iacute;a entrar a tu cuenta de Ululand.', 'creamy', 'width: 250, hook: {target: "topRight", tip: "topLeft"}, stem: "leftTop", showOn: "focus", hideOn: "blur", title: "Recordarte"'); ?>