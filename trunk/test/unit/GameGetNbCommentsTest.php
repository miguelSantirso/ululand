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

$t->diag('Game::getNbComments()');
$t->diag('Juego: Simple Arkanoid(tiene 0 comentarios)');

$t->isa_ok($game->getNbComments(), 'integer', '$game->getNbComments() retorna un entero.');

$t->is($game->getNbComments(), '0', '$game->getNbComments() retorna el numero de comentarios en el perfil del juego Simple Arkanoid(0 comentarios)');
