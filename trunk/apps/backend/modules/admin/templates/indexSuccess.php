<?php use_helper('Validation'); ?>

<h2 id="pageTitle"><?php echo link_to(image_tag("iconOptions.png").__('Administration'), '/'); ?></h2>

<div class="contentBox">
	
	<h3 class="header">Acciones rápidas</h3>

	<?php $linkText = image_tag("iconGames.png") . sprintf('%s<span>%s</span>', __("Add New Game"), __("Add a new game to the system in one step.")); ?>
	<?php echo link_to($linkText, '/game/addGame', array('class' => 'largeIconButton')); ?>
	
</div>

<div class="contentRow">
<div class="contentBox">

	<h3 class="header">Administración manual</h3>

	<ul>
		<li><?php echo link_to('Administrar cuentas de usuario', 'sfGuardUser/index'); ?>
			<ul>
			    <li><?php echo link_to('Administrar jugadores', 'playerprofile'); ?></li>
				<li><?php echo link_to('Administrar grupos de usuarios', 'sfGuardGroup'); ?></li>
				<li><?php echo link_to('Administrar amistades', 'friendship'); ?></li>
				<li><?php echo link_to('Administrar permisos de usuarios', 'sfGuardPermission'); ?></li>
			</ul>
		</li>
		<li><?php echo link_to('Administrar avatares', 'avatar/index'); ?>
			<ul>
				<li><?php echo link_to('Administrar mensajes', 'message'); ?></li>
				<li><?php echo link_to('Administrar piezas de avatares', 'avatarPiece'); ?></li>
				<li><?php echo link_to('Administrar relaci&oacute;n avatares y objetos', 'avatar_item'); ?></li>
			</ul>
		</li>
		<li><?php echo link_to('Administrar grupos', 'group/index'); ?>
			<ul>
				<li><?php echo link_to('Administrar relaci&oacute;n grupos y jugadores', 'playerprofile_group'); ?></li>
			</ul>
		<li><?php echo link_to('Administrar juegos', 'game/index'); ?>
				<ul>
					<li><?php echo link_to('Administrar releases de los juegos', 'gameRelease'); ?></li>
					<li><?php echo link_to('Administrar estados de las releases', 'gameReleaseStatus'); ?></li>
				</ul>
		</li>
		<li><?php echo link_to('Administrar estad&iacute;sticas de partida', 'gamestat/index'); ?>
			<ul>
				<li><?php echo link_to('Administrar valores de las estad&iacute;sticas de partida', 'gamestat_playerprofile'); ?></li>
			</ul>
		</li>
		<li><?php echo link_to('Administrar competiciones', 'competition/index'); ?>
			<ul>
				<li><?php echo link_to('Administrar relaci&oacute;n competiciones y jugadores', 'competition_playerprofile'); ?></li>
			</ul>
		</li>
		<li><?php echo link_to('Administrar widgets', 'widget/index'); ?></li>
		<li><?php echo link_to('Administrar ofertas de colaboración', 'collaboration/index'); ?></li>
		<li><?php echo link_to('Administrar recetas de código', 'codePiece/index'); ?></li>
	</ul>
	
</div>
</div>	