document.write('<link rel="stylesheet" type="text/css" media="screen" href="http://ululand/sfSyntaxHighlighterPlugin/css/SyntaxHighlighter.css" />');

<?php
	$trans = get_html_translation_table(HTML_ENTITIES);
	$html_code = strtr($html_code, $trans); 
	$title = '<h4>' . ($code_piece->getTitle()) . '</h4>';
	$formattedSource =  sfMarkdown::doConvert($code_piece->getSource());
	//$formattedSource = str_replace("\n", $formattedSource);
	$sourceLines = explode("\n", ($formattedSource));
?>

document.write('<div id="ululandCookbookRecipe-<?php echo $code_piece->getId(); ?>">');

document.write('<?php echo $title; ?>');

<?php foreach($sourceLines as $sourceLine) : ?>
	document.write('<?php echo $sourceLine; ?>');
<?php endforeach; ?>

document.write('</div>');
