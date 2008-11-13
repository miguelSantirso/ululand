<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."No somos administradores --> codigo de estado 401 Unauthorized"."\n";
$browser->get('/playerprofile')->
  isStatusCode(401)->
  isRequestParameter('module', 'playerprofile');

echo "\n"."Nos identificamos como el usuario Prueba(administrador)"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'prueba@prueba.com', 'password' => 'prueba'))->
  isStatusCode(302);

echo "\n"."Probando la accion list del modulo playerprofile de backend"."\n"; 
$browser->get('/playerprofile/list')->
  isStatusCode(200)->
  isRequestParameter('module', 'playerprofile')->
  isRequestParameter('action', 'list');
  
echo "\n"."Probando la accion edit del modulo playerprofile de backend"."\n"; 
$browser->get('/playerprofile/edit/id/5')->
  isStatusCode(200)->
  isRequestParameter('module', 'playerprofile')->
  isRequestParameter('action', 'edit');
