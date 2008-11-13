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

$t->diag('PlayerProfile::getNbGroups()');
$t->diag('Jugador: Prueba(pertenece a 1 grupo)');

$t->isa_ok($player->getNbGroups(), 'integer', '$player->getNbgroups() retorna un entero.');

$t->is($player->getNbGroups(), '1', '$player->getNbGroups() retorna el numero de grupos a los que pertenece el jugador Prueba(1 grupo)');
