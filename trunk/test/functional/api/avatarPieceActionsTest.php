<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."Nos identificamos como el usuario miguelSantirso"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'tirso.00@gmail.com', 'password' => 'tirsotirso'))->
  isStatusCode(200);

echo "\n"."Probando la accion get del modulo avatarPiece de la api"."\n"; 
$browser->get('/avatarPiece/get/pieceUuid/d8bc23e9-3839-0024-09a0-48613dbaa625')->
  isStatusCode(200)->
  isRequestParameter('module', 'avatarPiece')->
  isRequestParameter('action', 'get');
  
echo "\n"."Probando la accion add del modulo avatarPiece de la api"."\n"; 
$browser->get('/avatarPiece/add/userUuid/c58e91fb-836f-3734-39c4-a5883cb8e0d6/name/Cabeza de Miguel')->
  isStatusCode(200)->
  isRequestParameter('module', 'avatarPiece')->
  isRequestParameter('action', 'add');
  
echo "\n"."Probando la accion edit del modulo avatarPiece de la api"."\n"; 
$browser->get('/avatarPiece/edit/pieceUuid/d8bc23e9-3839-0024-09a0-48613dbaa625')->
  isStatusCode(200)->
  isRequestParameter('module', 'avatarPiece')->
  isRequestParameter('action', 'edit');
  
echo "\n"."Probando la accion getByOwner del modulo avatarPiece de la api"."\n"; 
$browser->get('/avatarPiece/getByOwner/userUuid/c58e91fb-836f-3734-39c4-a5883cb8e0d6')->
  isStatusCode(200)->
  isRequestParameter('module', 'avatarPiece')->
  isRequestParameter('action', 'getByOwner');