<?php if($game) { ?>
	
	<?php
		if(!isset($width))
			$width = $game->getWidth().'px';
		if(!isset($height))
			$height = $game->getHeight().'px';
	?>
	
	<object id='widget-<?php echo $game->getId(); ?>' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'
		codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/
			swflash.cab#version=9,0,0,0'
		width='<?php echo $width; ?>' height='<?php echo $height; ?>'>
		<param name='src' value='<?php echo $game->getGameUrl(); ?>' />
		<param name="wmode" value="transparent">
		<param name='flashVars' value='<?php echo($flashVars); ?>' />
		<embed name='mySwf' src='<?php echo $game->getGameUrl(); ?>'
			pluginspage='http://
			www.macromedia.com/shockwave/download/
			index.cgi?P1_Prod_Version=ShockwaveFlash'
			width='<?php echo $width; ?>' height='<?php echo $height; ?>'
			wmode="transparent"
			flashVars='<?php echo($flashVars); ?>' />
	</object>

<?php } else { ?>

	<p class="strongColor">El juego solicitado no ha sido cargado en el sistema</p>

<?php } ?>