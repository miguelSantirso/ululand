<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."No somos administradores --> codigo de estado 401 Unauthorized"."\n";
$browser->get('/codePiece')->
  isStatusCode(401)->
  isRequestParameter('module', 'codePiece');

echo "\n"."Nos identificamos como el usuario Prueba(administrador)"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'prueba@prueba.com', 'password' => 'prueba'))->
  isStatusCode(302);
  
echo "\n"."Probando la accion list del modulo codePiece de backend"."\n"; 
$browser->get('/codePiece/list')->
  isStatusCode(200)->
  isRequestParameter('module', 'codePiece')->
  isRequestParameter('action', 'list');
  
echo "\n"."Probando la accion edit del modulo codePiece de backend"."\n"; 
$browser->get('/codePiece/edit/id/1')->
  isStatusCode(200)->
  isRequestParameter('module', 'codePiece')->
  isRequestParameter('action', 'edit');
