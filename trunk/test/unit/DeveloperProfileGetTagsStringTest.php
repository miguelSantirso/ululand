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

$t->diag('DeveloperProfile::getTagsString()');
$t->diag('Desarrollador: miguelSantirso(tags: as3, programador)');

$t->isa_ok($developer->getTagsString(), 'string', '$developer->getTagsString() retorna un string.');

$t->is($developer->getTagsString(), "as3, programador", '$developer->getTagsString() retorna los tags del desarrollador miguelSantirso(as3, programador)');
