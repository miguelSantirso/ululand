<?php
/**
 * Vista del campo parcial _image. Sirve para visualizar la imagen asociada a un �tem.
 *
 **/
	$imageHref = $item->getImageHref();
	if($imageHref == "null")
		echo "No hay imagen asociada a&uacute;n.";
	else
		echo "<img src='".$item->getImageHref()."' />" 
?>