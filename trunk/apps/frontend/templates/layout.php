<?php use_helper("Tooltip"); ?>
<?php use_helper("I18N"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>

<div id="userMenu">
	<ul class="horizontalListMenu small">
		<?php if( $sf_user->isAuthenticated() ) { ?>
			<li id="roomLink"><?php echo link_to('Mi Habitaci&oacute;n', 'profile/show?id='.$this->getContext()->getUser()->getAttribute('avatarId')); ?></li>
			<li id="logoutLink"><?php echo link_to(__('Logout'), '@sf_guard_signout'); ?></li>
			<?php echo tooltip_script('roomLink', 'Ir a tu habitaci&oacute;n para ver los &uacute;ltimos mensajes recibidos, tus amigos, tu aspecto o las &uacute;ltimas puntuaciones que hayas obtenido.', 'creamy', 'title: "Tu habitaci&oacute;n", stem: "topRight", hook: {target: "bottomLeft", tip: "topRight"}, width: 225, offset: {x: 10, y: 0}'); ?>
			<?php echo tooltip_script('logoutLink', 'La pr&oacute;xima vez que entres tendr&aacute;s que identificarte.', 'creamy', 'title: "Salir", stem: "topRight", hook: {target: "bottomLeft", tip: "topRight"}, width: 225, offset: {x: 10, y: 0}'); ?>
		<?php } else { ?>
			<li id="loginLink"><?php echo link_to(__('Login'), '@sf_guard_signin'); ?></li>
			<li id="registerLink"><?php echo link_to(__('Register'), '@sf_guard_signin'); ?></li>
			<?php echo tooltip_script('loginLink', '&iexcl;Haz clic para iniciar sesi&oacute;n y comenzar a divertirte!', 'creamy', 'title: "Entrar en Ululand", stem: "topRight", hook: {target: "bottomLeft", tip: "topRight"}, width: 175, offset: {x: 10, y: 0}'); ?>
			<?php echo tooltip_script('registerLink', 'Haz clic para abrir una cuenta nueva en Ululand.', 'creamy', 'title: "Registrarse en Ululand", stem: "topRight", hook: {target: "bottomLeft", tip: "topRight"}, width: 175, offset: {x: 10, y: 0}'); ?>
		<?php } ?>
		<?php if( $sf_user->hasCredential('admin') ): ?>
			<li><a href="/backend.php">Administrador</a></li>
		<?php endif; ?>
	</ul>
</div>
<div id="header" class="rounded">
	<div id="mainMenu" class="rounded">
		<ul class="horizontalListMenu">
			<li><?php echo link_to(image_tag('header_logo.png'), 'home/Welcome', array("id" => "homeMenuLink")); ?></li>
		    <li id="gamesMenuLink"><?php echo link_to('Juegos', 'game'); ?></li>
		    <li id="peopleMenuLink"><?php echo link_to('Gente', 'profile'); ?></li>
		    <li id="groupMenuLink"><?php echo link_to('Grupo', 'group'); ?></li>
		    <li id="blogMenuLink"><?php echo link_to('Blog', 'http://blog.pncil.com/'); ?></li>
		    <li class="last"></li>
		</ul>
	</div>
</div>

<p id="indicator" class="messageBox warning" style="display: none"> Operaci&oacute;n en curso </p>

<!-- Cajitas especiales de avisos -->
<?php if($sf_flash->has('error')): ?>
  <p class="messageBox error"><?php echo $sf_flash->get('error'); ?></p>
<?php endif; ?>
<?php if($sf_flash->has('warning')): ?>
  <p class="messageBox warning"><?php echo $sf_flash->get('warning'); ?></p>
<?php endif; ?>
<?php if($sf_flash->has('success')): ?>
  <p class="messageBox success"><?php echo $sf_flash->get('success'); ?></p>
<?php endif; ?>


<div id="content" class="rounded">
	
	<?php echo $sf_data->getRaw('sf_content') ?> 
	
	<div style="clear: both"></div>
</div>
 
<div id="footer" class="alignCenter">
	<p><strong>ulu</strong>land versi&oacute;n <?php echo sfConfig::get('app_version'); ?>. Desarrollado por <a href="#">Christian Ca&ntilde;ete</a> &amp; <a href="http://miguelsantirso.es">Miguel Santirso</a></p>
	<br/>
	<!-- <p><a href="http://validator.w3.org/check?uri=referer">XHTML v&aacute;lido.</a></p>  -->
	
</div>

<?php echo tooltip_script('homeMenuLink', 'Volver a la portada', 'lightGrey'); ?>
<?php echo tooltip_script('gamesMenuLink', 'Todos los juegos', 'lightGrey'); ?>
<?php echo tooltip_script('peopleMenuLink', 'Las habitaciones de la gente', 'lightGrey', 'stem: "topMiddle"'); ?>
<?php echo tooltip_script('forumMenuLink', 'El foro de <strong>ulu</strong>land', 'lightGrey', 'stem: "topMiddle"'); ?>
<?php echo tooltip_script('wikiMenuLink', 'El Wiki de <strong>ulu</strong>land', 'lightGrey', 'stem: "topMiddle"'); ?>
<?php echo tooltip_script('blogMenuLink', 'Ir al blog de <span style="font-family: Serif">pncil</span>.', 'lightGrey', 'stem: "topMiddle"'); ?>

</body>
</html>
