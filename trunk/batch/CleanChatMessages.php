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

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/..'));
define('SF_APP',         'backend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       1);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

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
