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
$developer = DeveloperProfilePeer::retrieveByPK(2);

$t->diag('DeveloperProfile::getNbCollaborations()');
$t->diag('Desarrollador: miguelSantirso(tiene 3 colaboraciones)');

$t->isa_ok($developer->getNbCollaborations(), 'integer', '$developer->getNbCollaborations() retorna un entero.');

$t->is($developer->getNbCollaborations(), '3', '$developer->getNbCollaborations() retorna el numero de colaboraciones del desarrollador miguelSantirso(3 colaboraciones)');
