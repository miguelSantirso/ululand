<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."No somos administradores --> codigo de estado 401 Unauthorized"."\n";
$browser->get('/collaboration')->
  isStatusCode(401)->
  isRequestParameter('module', 'collaboration');

echo "\n"."Nos identificamos como el usuario Prueba(administrador)"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'prueba@prueba.com', 'password' => 'prueba'))->
  isStatusCode(302);

echo "\n"."Probando la accion list del modulo collaboration de backend"."\n"; 
$browser->get('/collaboration/list')->
  isStatusCode(200)->
  isRequestParameter('module', 'collaboration')->
  isRequestParameter('action', 'list');
  
echo "\n"."Probando la accion edit del modulo collaboration de backend"."\n"; 
$browser->get('/collaboration/edit/id/4')->
  isStatusCode(200)->
  isRequestParameter('module', 'collaboration')->
  isRequestParameter('action', 'edit');
