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

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');
$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'dev', false);
sfContext::createInstance($configuration);

// initialize database manager
$databaseManager = new sfDatabaseManager($configuration);
$databaseManager->loadConfiguration();

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

