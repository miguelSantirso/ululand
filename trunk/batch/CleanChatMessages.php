<?php

/**
 * CleanChatMessages batch script
 *
 * Limpia la tabla que almacena los mensajes del chat. Elimina los objetos con una antiguedad mayor a 24 horas
 *
 * @package    PFC
 * @subpackage batch
 * @version    $Id$
 */

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');
$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'dev', false);
sfContext::createInstance($configuration);

// initialize database manager
$databaseManager = new sfDatabaseManager($configuration);
$databaseManager->loadConfiguration();

// batch process here

$stamp = time ();
$stamp -= 60 * 60 * 11;

$c = new Criteria();
$c->add(ChatMessagePeer::CREATED_AT, date ("Y-m-d H:i:s", $stamp), Criteria::LESS_THAN);

$messagesToRemove = ChatMessagePeer::doSelect($c);

foreach ($messagesToRemove as $message)
{
	$message->delete();
}
