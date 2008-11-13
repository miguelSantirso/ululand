<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."Nos identificamos como el usuario Prueba"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'prueba@prueba.com', 'password' => 'prueba'))->
  isStatusCode(302);

echo "\n"."Probando la accion index del modulo juego"."\n"; 
$browser->get('/game/index')->
  isStatusCode(200)->
  isRequestParameter('module', 'game')->
  isRequestParameter('action', 'index');

echo "\n"."Probando la accion list del modulo juego"."\n";
$browser->get('/game/list')->
  isStatusCode(200)->
  isRequestParameter('module', 'game')->
  isRequestParameter('action', 'list');

echo "\n"."Probando la accion show del modulo juego"."\n";
$browser->get('/game/show/stripped_name/simple-arkanoid')->
  isStatusCode(200)->
  isRequestParameter('module', 'game')->
  isRequestParameter('action', 'show');
  
$browser->get('/game/show/stripped_name/simple-arkanoid')->
    isRequestParameter('stripped_name', "simple-arkanoid")->
    isStatusCode(200)->
    isResponseHeader('content-type', 'text/html; charset=utf-8')->
    responseContains('show');