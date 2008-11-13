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

$user = sfGuardUserProfilePeer::retrieveByPK(3);

$t->diag('PlayerProfile::isPlayer()');
$t->diag('Usuario: Prueba(es jugador)');

$t->isa_ok($user->isPlayer(), 'boolean', '$user->isPlayer() retorna un booleano.');
$t->is($user->isPlayer(), true, '$user->isPlayer() retorna cierto ya que el usuario Prueba es un jugador');
