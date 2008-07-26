<?php use_helper('Validation'); ?>
	<div class="fixedWidth wide normalBox subtle">
		<h2 class="alignCenter">Hacerse socio</h2>
		<p class="alignCenter">Con tu cuenta podr&aacute;s acceder a <strong>ulu</strong>land.</p>
	</div>

<!-- Register form -->
<div class="fixedWidth medium alignLeft">
	<?php echo form_tag('home/Register', array('name' => 'registerForm', 'class' => 'card')); ?>
	<fieldset class="labelsAtRight">
	<legend class="xLarge">Registro</legend>
	<ol class="large">
		<li>
			<?php echo form_error('email', array("class" => "small subtleEmphasis")) ?>
			<?php echo label_for('email', 'Email') ?>
			<?php echo input_tag('email', null, array("class" => "large")) ?>
		</li>
		<li>
			<?php echo form_error('confirmEmail', array("class" => "small subtleEmphasis")) ?>
			<?php echo label_for('confirmEmail', 'Email, otra vez') ?>
			<?php echo input_tag('confirmEmail', null, array("class" => "large", "onfocus" => "Element.show('confirmTooltip');", "onblur" => "Element.hide('confirmTooltip');")) ?>
		</li>
		<li>
			<?php echo form_error('password', array("class" => "small subtleEmphasis")) ?>
			<?php echo label_for('password', 'Contrase&ntilde;a') ?>
			<?php echo input_password_tag('password', null, array("class" => "large")) ?>
		</li>
	</ol>
	<?php echo submit_tag('Crear cuenta', array('class' => 'submit wide large')) ?>
	</fieldset>
	<?php if ($sfContext->getActionStack()->getFirstEntry()->getModuleName() != 'Register'): ?> 
	    <?php echo input_hidden_tag('referer', $sf_params->get('referer') ? $sf_params->get('referer') : $sf_request->getUri()) ?>    
	<?php endif ?>
	</form>

</div>

<div class="fixedWidth medium alignRight">
	<div class="normalBox subtle">
		<h3 class="alignCenter">Eh, eh. Que yo ya soy socio, amigo.</h3>
		<h4>Disculpe, se&ntilde;or. No le recordaba.</h4>
		<p class="small">Perd&oacute;n. Normalmente nos acordamos de nuestros socios pero bueno, no pasa nada. Quiz&aacute;s lleves tiempo sin venir o te est&eacute;s conectando desde un ordenador diferente.</p>
		<p><?php echo link_to('Identif&iacute;cate en <strong>ulu</strong>land &raquo;', 'home/Login', array('class' => 'navigation')) ?></p>
	</div>
	<div class="normalBox subtle">
		<h3 class="alignCenter">Ehh... Hola, buenos d&iacute;as</h3>
		<h4>Fant&aacute;stico.</h4>
		<p class="small">Estas a medio minuto de ser socio de <strong>ulu</strong>land. Solo tienes que rellenar el formulario de la izquierda. &iquest;Todav&iacute;a no terminaste? Venga hombre, si solo son tres tonter&iacute;as.</p>
		<h4>&iquest;Necesitas m&aacute;s argumentos?</h4>
		<p class="small">As&iacute; que eres de los dificilmente impresionables. Dif&iacute;cil de convencer. Te gusta hacerte de rogar. &iexcl;Oh, vamos! Ya has llegado hasta aqu&iacute;. Podr&iacute;a decirte que en Ululand hay un mont&oacute;n de juegos. Y un mont&oacute;n de gente. Y que nos lo pasamos genial. O chupi. Pero, claro, eso ya lo sabes. T&uacute; lo que quieres es que te contemplen. Que te adoren. Que est&eacute;n detr&aacute;s de ti, en una palabra. Pues lo siento; o te haces socio o no sabr&aacute;s nunca lo que es <strong>Ulu</strong>land.</p>
	</div>
</div>

<?php use_helper('Tooltip'); ?>
<?php echo tooltip_script('email', 'Te servir&aacute; como identificador dentro de Ululand; deber&aacute;s utilizarla cada vez que quieras entrar.<br/>Adem&aacute;s, la usaremos para avisarte de cosas importantes, as&iacute; que aseg&uacute;rate de que es v&aacute;lida.', 'creamy', 'width: 250, hook: {target: "topRight", tip: "topLeft"}, stem: "leftTop", showOn: "focus", hideOn: "blur", title: "Direcci&oacute;n de E-Mail"'); ?>
<?php echo tooltip_script('confirmEmail', 'Esto nos sirve para asegurarnos de que no te confundes al escribir la direcc&oacute;n. Esto es muy importante porque si te equivocases no podr&iacute;as acceder al sistema.', 'creamy', 'width: 250, hook: {target: "topRight", tip: "topLeft"}, stem: "leftTop", showOn: "focus", hideOn: "blur", title: "Confirmar el E-Mail"'); ?>
<?php echo tooltip_script('password', 'Deber&aacute;s usar esta contrase&ntilde;a para acceder a Ululand. Procura que no sea demasiado evidente y nunca se la digas a nadie.<br/>Puedes usar caracteres, n&uacute;meros y s&iacute;mbolos como @, #, &amp;, etc...', 'creamy', 'width: 250, hook: {target: "topRight", tip: "topLeft"}, stem: "leftTop", showOn: "focus", hideOn: "blur", title: "Contrase&ntilde;a"'); ?>