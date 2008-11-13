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
$group = GroupPeer::doSelectOne($c);
$player = PlayerProfilePeer::retrieveByPK(2);

$t->diag('Group::getStatus()');
$t->diag('Grupo: Administracion');
$t->diag('Jugador: Prueba(propietario del grupo)');

$t->isa_ok($group->getStatus($player), 'string', 'Administracion->getStatus(Prueba) retorna un string.');

$t->is($group->getStatus($player), GroupPeer::OWNER, 'Administracion->getStatus(Prueba) retorna el estado PROPIETARIO del jugador Prueba dentro del grupo');
$t->isnt($group->getStatus($player), GroupPeer::MEMBER, 'Administracion->getStatus(Prueba) no retorna el estado MIEMBRO');
$t->isnt($group->getStatus($player), GroupPeer::NOT_MEMBER, 'Administracion->getStatus(Prueba) no retorna el estado NO MIEMBRO');
$t->isnt($group->getStatus($player), GroupPeer::PENDING, 'Administracion->getStatus(Prueba) no retorna el estado PENDIENTE');
