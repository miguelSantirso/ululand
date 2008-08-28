
<?php
	
	$baseUrl = ulToolkit::getBaseUrl();
	 
?>

// Incluir el Core de la librería SyntaxHighlighter
IncludeJavaScript('<?php echo $baseUrl; ?>/sfSyntaxHighlighterPlugin/js/shCore.js');

// Obtener todos los lenguajes soportados
<?php $languages = sfSyntaxHighlighterToolkit::getAvailableBrushes(); ?>

// Añadir los brushes para que se resalte el código de cualquier lenguaje
<?php foreach($languages as $language) : ?>
IncludeJavaScript('<?php echo $baseUrl; ?>/sfSyntaxHighlighterPlugin/js/<?php echo $language["js"] ?>.js');
<?php endforeach; ?>

// Añadir la hoja de estilos
document.write('<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $baseUrl; ?>/sfSyntaxHighlighterPlugin/css/SyntaxHighlighter.css" />');

<?php
	// Procesar los datos a mostrar
	$trans = get_html_translation_table(HTML_ENTITIES);
	$html_code = strtr($html_code, $trans); 
	$title = '<h4>' . ($code_piece->getTitle()) . '</h4>';
	$formattedSource =  sfMarkdown::doConvert($code_piece->getSource());
	$sourceLines = explode("\n", ($formattedSource));
?>

// ESCRIBIR EL CÓDIGO HTML:

document.write('<div id="ululandCookbookRecipe-<?php echo $code_piece->getId(); ?>">');

document.write('<?php echo $title; ?>');

<?php foreach($sourceLines as $sourceLine) : ?>
	document.write('<?php echo addslashes( $sourceLine ) ?>'+'\n');
<?php endforeach; ?>

<?php $link = link_to('developers.ululand.com', 'http://developers.ululand.com', array('style' => 'color: #006eb3;')); ?>
document.write('<div style="font-family: arial, sans-serif; margin: -5px 0 0 10px; text-align: right; font-size: 13px; color: #696969; background: #fff; padding: 4px;"><strong>Syntax highlighting powered by <?php echo $link; ?></strong></div>');
document.write('</div>');

// Añadir el código necesario para que se ejecute el resaltador de código
IncludeJavaScriptContent('dp.SyntaxHighlighter.ClipboardSwf = "<?php echo $baseUrl; ?>/sfSyntaxHighlighterPlugin/js/clipboard.swf";dp.SyntaxHighlighter.HighlightAll("code");');



/* auxiliary functions */

// Function to allow one JavaScript file to be included by another.
// Copyright (C) 2006-08 www.cryer.co.uk
function IncludeJavaScript(jsFile)
{
  document.write('<script type="text/javascript" src="'
    + jsFile + '"></scr' + 'ipt>'); 
}

// Function to allow some JavaScript code to be included by another.
// Copyright (C) 2008 miguelSantirso.es
function IncludeJavaScriptContent(content)
{
  document.write('<script type="text/javascript">'+content+'</scr' + 'ipt>'); 
}