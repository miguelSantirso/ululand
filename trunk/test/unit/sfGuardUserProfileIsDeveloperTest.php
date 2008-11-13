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

$t = new lime_test(4, new lime_output_color());

$user = sfGuardUserProfilePeer::retrieveByPK(3);

$t->diag('PlayerProfile::isDeveloper()');
$t->diag('Usuario: Prueba(no es desarrollador)');

$t->isa_ok($user->isDeveloper(), 'boolean', '$user->isDeveloper() retorna un booleano.');
$t->is($user->isDeveloper(), false, '$user->isDeveloper() retorna falso ya que el usuario Prueba no es un desarrollador');

$user = sfGuardUserProfilePeer::retrieveByPK(2);

$t->diag('PlayerProfile::isDeveloper()');
$t->diag('Usuario: miguelSantirso(es desarrollador)');

$t->isa_ok($user->isDeveloper(), 'boolean', '$user->isDeveloper() retorna un booleano.');
$t->is($user->isDeveloper(), true, '$user->isDeveloper() retorna cierto ya que el usuario miguelSantirso es un desarrollador');
