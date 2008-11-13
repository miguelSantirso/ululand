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
$game = GamePeer::retrieveByPK(1);

$t->diag('Game::getWidth()');
$t->diag('Juego: Simple Arkanoid(tiene anchura 640)');

$t->isa_ok($game->getWidth(), 'integer', '$game->getWidth() retorna un entero.');

$t->is($game->getWidth(), '640', '$game->getWidth() retorna la anchura en pixeles de la version activa del juego Simple Arkanoid(anchura 640)');
