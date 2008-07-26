<?php

// Requerimos la clase apiCommonActions que nos proporciona las acciones b�sicas de la api al heredar de ella.
require_once dirname(__FILE__).'/../../../lib/apiCommonActions.class.php';

/**
 * item actions.
 *
 * @package    PFC
 * @subpackage item
 * @author     Miguel Santirso
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class itemActions extends apiCommonActions
{
	/**
	 * Executes index action
	 *
	 */
	public function executeIndex()
	{
	}

	
	/**
	 * Retorna toda la informaci�n acerca de todos los �tems almacenados en el sistema
	 * Admite, opcionalmente, el par�metro 'filterByType' que hace que se retornen unicamente
	 * aquellos �tems cuyo tipo coincide con el indicado.
	 *
	 */
	public function executeGetAll()
	{
		// Obtener todos los items, haciendo un simple select con el criteria vac�o.
		$items = ItemPeer::doSelect(new Criteria());
		$result = Array();
		$i = 0;
		foreach($items as $item)
		{
			if(!$this->getRequestParameter('filterByType') || $this->getRequestParameter('filterByType') == $item->getItemType()->getName())
			{
				$result[$i]["Id"] = $item->getId();
				$result[$i]["Name"] = $item->getName();
				$result[$i]["Description"] = $item->getDescription();
				$result[$i]["Price"] = $item->getPrice();
				$result[$i]["Url"] = $item->getImageHref();
				$result[$i]["Type"] = $item->getItemType()->getName();

				$i++;
			}
		}
		
		$this->returnApi($result);
	}
	
}
