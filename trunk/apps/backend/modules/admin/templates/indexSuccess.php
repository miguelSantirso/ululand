<?php use_helper('Validation'); ?>

<div class="contentColumn wide normalBox lightColor">
	<h2 class="alignCenter">Administraci&oacute;n</h2>
	<p class="alignCenter">La zona de los que mandan.</p>
</div>

	<ul>
		<li><?php echo link_to('Administrar cuentas de usuario', 'sfGuardUser'); ?>
			<ul>
			    <li><?php echo link_to('Administrar jugadores', 'playerprofile'); ?></li>
				<li><?php echo link_to('Administrar grupos de usuarios', 'sfGuardGroup'); ?></li>
				<li><?php echo link_to('Administrar amistades', 'friendship'); ?></li>
				<li><?php echo link_to('Administrar permisos de usuarios', 'sfGuardPermission'); ?></li>
			</ul>
		</li>
		<li><?php echo link_to('Administrar avatares', 'avatar'); ?>
			<ul>
				<li><?php echo link_to('Administrar mensajes', 'message'); ?></li>
				<li><?php echo link_to('Administrar piezas de avatares', 'avatarPiece'); ?></li>
				<li><?php echo link_to('Administrar relaci&oacute;n avatares y objetos', 'avatar_item'); ?></li>
			</ul>
		</li>
		<li><?php echo link_to('Administrar grupos', 'group'); ?>
			<ul>
				<li><?php echo link_to('Administrar relaci&oacute;n grupos y jugadores', 'playerprofile_group'); ?></li>
			</ul>
		<li><?php echo link_to('Administrar juegos', 'game'); ?>
				<ul>
					<li><?php echo link_to('Administrar releases de los juegos', 'gameRelease'); ?></li>
					<li><?php echo link_to('Administrar estados de las releases', 'gameReleaseStatus'); ?></li>
				</ul>
		</li>
		<li><?php echo link_to('Administrar estad&iacute;sticas de partida', 'gamestat'); ?>
			<ul>
				<li><?php echo link_to('Administrar valores de las estad&iacute;sticas de partida', 'gamestat_avatar'); ?></li>
				<li><?php echo link_to('Administrar tipos de estad&iacute;sticas de partida', 'gamestattype'); ?></li>
			</ul>
		</li>
		<li><?php echo link_to('Administrar competiciones', 'competition'); ?>
			<ul>
				<li><?php echo link_to('Administrar relaci&oacute;n competiciones y jugadores', 'competition_playerprofile'); ?></li>
			</ul>
		</li>
		<li><?php echo link_to('Administrar widgets', 'widget'); ?>
		</li>
		<li><?php echo link_to('Administrar ofertas de colaboración', 'collaboration'); ?></li>
		<li><?php echo link_to('Administrar recetas de código', 'codePiece'); ?>
			<ul>
				<li><?php echo link_to('Administrar lenguajes de programación para las recetas', 'codePieceLanguage'); ?></li>
			</ul>
		</li>
	</ul>