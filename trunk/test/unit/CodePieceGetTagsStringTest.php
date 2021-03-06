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
$codePiece = CodePiecePeer::retrieveByPK(1);

$t->diag('CodePiecePeer::getTagsString()');
$t->diag('Receta de c�digo: Uso de Addchild(tags: actionscript, addchild, as3, bitmap)');

$t->isa_ok($codePiece->getTagsString(), 'string', 'Uso_de_AddChild->getTagsString() retorna un string.');

$t->is($codePiece->getTagsString(), "actionscript, addchild, as3, bitmap", 'Uso_de_AddChild->getTagsString() retorna los tags de la receta de c�digo');
