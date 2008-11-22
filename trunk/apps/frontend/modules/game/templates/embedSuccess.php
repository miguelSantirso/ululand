
<?php
	
	$baseUrl = ulToolkit::getBaseUrl();
	 
?>


// Añadir la hoja de estilos
document.write('<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $baseUrl; ?>/css/embedGame.css" />');

// ESCRIBIR EL CÓDIGO HTML:

document.write('<div id="ululandGame-<?php echo $game->getStrippedName(); ?>" class="gameBox alignCenter" style="width: <?php echo $game->getWidth() ?>px">');
	document.write('<h3 class="gameBoxTitle"><?php echo linkToGameWithThumbnail($game, 40); ?></h3>');
	document.write("<?php include_component('game', 'releaseEmbed', array('gameId' => $game->getId())) ?>");
document.write('</div>');
