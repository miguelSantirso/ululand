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

$avatarPiece = AvatarPiecePeer::retrieveByPK(5);

$t->diag('AvatarPiecePeer::__toString()');
$t->diag('Pieza de avatar: Cabeza de Miguel');

$t->isa_ok($avatarPiece->__toString(), 'string', '$avatarPiece->__toString() retorna un string.');

$t->is($avatarPiece->__toString(), "Cabeza de Miguel", '$avatarPiece->__toString() retorna el nombre de la pieza de avatar(Cabeza de Miguel)');
