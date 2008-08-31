
<?php
	
	$baseUrl = ulToolkit::getBaseUrl();
	 
?>


// Añadir la hoja de estilos
document.write('<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $baseUrl; ?>/css/geshi.css" />');

<?php
	// Procesar los datos a mostrar
	$title = linkToRecipe($code_piece);
	$author = linkToProfile($code_piece->getsfGuardUser()->getProfile());
	$formattedSource =  $code_piece->getHtmlSource();
	$sourceLines = explode("\n", ($formattedSource));
?>

// ESCRIBIR EL CÓDIGO HTML:

document.write('<div id="ululandCookbookRecipe-<?php echo $code_piece->getId(); ?>">');

document.write('<div style="font-family: arial, sans-serif; margin: 0 0 0 0; font-size: 13px; color: #696969; background: #fff; padding: 4px;"><strong><?php echo $title; ?></strong> by <?php echo $author; ?></div>');
<?php foreach($sourceLines as $sourceLine) : ?>
	document.write('<?php echo addslashes( $sourceLine ) ?>'+'\n');
<?php endforeach; ?>

<?php $link = link_to('developers.ululand.com', 'http://developers.ululand.com', array('style' => 'color: #006eb3;')); ?>
document.write('<div style="font-family: arial, sans-serif; margin: 0; text-align: right; font-size: 13px; color: #696969; background: #fff; padding: 4px;"><strong>Syntax highlighting powered by <?php echo $link; ?></strong></div>');
document.write('</div>');

