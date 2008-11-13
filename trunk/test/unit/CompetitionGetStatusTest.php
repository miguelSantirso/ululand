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

$t = new lime_test(5, new lime_output_color());

$c = new Criteria();
$competition = CompetitionPeer::doSelectOne($c);
$player = PlayerProfilePeer::retrieveByPK(2);

$t->diag('Competition::getStatus()');
$t->diag('Competicion: Competition1');
$t->diag('Jugador: Prueba(propietario de la competicion)');

$t->isa_ok($competition->getStatus($player), 'string', 'Competition1->getStatus(Prueba) retorna un string.');

$t->is($competition->getStatus($player), CompetitionPeer::OWNER, 'Competition1->getStatus(Prueba) retorna el estado PROPIETARIO del jugador Prueba dentro de la competicion');
$t->isnt($competition->getStatus($player), CompetitionPeer::MEMBER, 'Competition1->getStatus(Prueba) no retorna el estado MIEMBRO');
$t->isnt($competition->getStatus($player), CompetitionPeer::NOT_MEMBER, 'Competition1->getStatus(Prueba) no retorna el estado NO MIEMBRO');
$t->isnt($competition->getStatus($player), CompetitionPeer::PENDING, 'Competition1->getStatus(Prueba) no retorna el estado PENDIENTE');
