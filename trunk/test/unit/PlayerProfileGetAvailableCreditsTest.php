<?php

//Para obtener la clase lime_test
//LA CARGA AUTOMATICA DE CLASES NO FUNCIONA EN LAS PRUEBAS UNITRIAS
include(dirname(__FILE__).'/../bootstrap/unit.php');

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/..'));
define('SF_APP',         'backend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       1);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

$t = new lime_test(2, new lime_output_color());

$c = new Criteria();
$player = PlayerProfilePeer::retrieveByPK(3);

$t->diag('PlayerProfile::getAvailableCredits()');
$t->diag('Jugador: Prueba(1000 creditos disponibles)');

$t->isa_ok($player->getAvailableCredits(), 'integer', '$player->getAvailableCredits() retorna un entero.');

$t->is($player->getAvailableCredits(), '1000', '$player->getAvailableCredits() retorna el numero de creditos disponibles del jugador Prueba(1000 creditos disponibles)');
