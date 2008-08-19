<?php

/**
 * CleanChatSessions batch script
 *
 * Limpia la tabla que almacena las sesiones de los usuarios del chat. Elimina los objetos con una antiguedad mayor a 24 horas.
 * Adem�s, suma los cr�ditos correspondientes a cada avatar por el tiempo jugado.
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
$stamp -= 60 * 60 * 12;

$c = new Criteria();
$c->add(ChatUserOnlinePeer::UPDATED_AT, date ("Y-m-d H:i:s", $stamp), Criteria::LESS_THAN);

$sessionsToRemove = ChatUserOnlinePeer::doSelect($c);

foreach ($sessionsToRemove as $session)
{
	// Calcular la duraci�n de la sesi�n
	$sessionLength = strtotime($session->getUpdatedAt()) - strtotime($session->getCreatedAt()); // en segundos
	// Obtener el avatar que ejecut� esta sesi�n
	$avatar = AvatarPeer::retrieveByApiKey($session->getAvatarApiKey());
	// Sumarle al avatar los cr�ditos que le correspondan por el tiempo jugado
	$avatar->addCreditsForPlayedTime($sessionLength);
	
	// La sesi�n ya ha sido procesada y no hace falta. La borramos
	$session->delete();
}