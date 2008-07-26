<?php

	/**
	 * Enter description here...
	 *
	 * @param string $remoteUrl Dirección a la que se enviará la información del formulario
	 * @param string $elementsToUpdate Cadena de los elementos a actualizar en caso de éxito o fallo
	 * @param string $elementToHighlight Elemento a iluminar cuando se complete la petición
	 * @param string $indicator Nombre del indicador de progreso
	 * 
	 * @example <form method="post" onsubmit="<?php echo ajaxUpdater_instance(url_for('@add_comment'), 'Success: "userComment"', 'userComment'); ?>">
	 */
	function ajaxUpdater_instance($remoteUrl, $elementsToUpdate, $elementToHighlight, $elementToRemove = null, $indicator = 'indicator')
	{
		return 'new Ajax.Updater({'.$elementsToUpdate.'}, "'.$remoteUrl.'", 
			{asynchronous:true, 
			insertion: Insertion.Bottom,
			evalScripts:false, 
			onComplete:function(request, json){
				Element.hide("'.$indicator.'");'.
				($elementToRemove ? 'Element.remove("'.$elementToRemove.'");': '')
				.'new Effect.Highlight("'.$elementToHighlight.'", {});
				},
			onLoading:function(request, json){
				Element.show("'.$indicator.'")},
			parameters:Form.serialize(this)});
			return false;';
	}
	
	
?>