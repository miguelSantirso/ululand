<?php
	/**
	 * Muestra un tooltip para el elemento dado
	 *
	 * @param string $element Elemento sobre el que se mostrará el tooltip
	 * @param string $content Contenido del tooltip
	 * @param string $style Estilo del tooltip
	 * @param string $options Opciones adicionales para el tooltip
	 * @example tooltip_script('element_id', 'Contenido del tooltip...', 'mainMenu', 'stem="topRight", border: 2');
	 * 
	 * @return string Código necesario para que aparezca el tooltip
	 */
	function tooltip_script($element, $content, $style='default', $options='')
	{
		return '
		<script type="text/javascript">
			new Tip(\''.$element.'\', \''.$content.'\', { style: "'.$style.'", '.$options.'});
		</script>
		';
	}
	
	function predefined_tooltip($tooltipName)
	{
		switch ($tooltipName)
		{
			case 'textileHelp':
				return tooltip_script('textileHelp', 'Puedes utilizar <em>Textile</em> para dar formato a este texto.<br/><strong>Ejemplos:</strong><br/>_cursiva_, *negrita*, "titulo del enlace":url<br/>'.link_to_wiki('Ayuda Detallada', 'TextileFormat').'<br/>', 'creamy', 'title: "Admite Textile", showOn: "click", hideOn: "click", stem: "leftBottom", closeButton: true, hook: {target: "rightBottom", tip: "leftBottom"}');
		}
	}
?>