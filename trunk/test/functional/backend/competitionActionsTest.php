<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."No somos administradores --> codigo de estado 401 Unauthorized"."\n";
$browser->get('/competition')->
  isStatusCode(401)->
  isRequestParameter('module', 'competition');

echo "\n"."Nos identificamos como el usuario Prueba(administrador)"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'prueba@prueba.com', 'password' => 'prueba'))->
  isStatusCode(302);

echo "\n"."Probando la accion list del modulo competition de backend"."\n"; 
$browser->get('/competition/list')->
  isStatusCode(200)->
  isRequestParameter('module', 'competition')->
  isRequestParameter('action', 'list');
  
echo "\n"."Probando la accion edit del modulo competition de backend"."\n"; 
$browser->get('/competition/edit/id/1')->
  isStatusCode(200)->
  isRequestParameter('module', 'competition')->
  isRequestParameter('action', 'edit');
