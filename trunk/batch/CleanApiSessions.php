<?php

/**
 * CleanApiSessions batch script
 *
 * Batch script que limpia las sesiones de la api que estén caducadas
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
$stamp -= 60 * 60 * 24;

$c = new Criteria();
$c->add(ApiSessionPeer::CREATED_AT, date ("Y-m-d H:i:s", $stamp), Criteria::LESS_THAN);

$sessionsToRemove = ApiSessionPeer::doSelect($c);

foreach ($sessionsToRemove as $session)
{
	$session->delete();
}

