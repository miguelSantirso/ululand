<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."Nos identificamos como el usuario Prueba"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'prueba@prueba.com', 'password' => 'prueba'))->
  isStatusCode(302);

echo "\n"."Probando la accion index del modulo perfil de jugador"."\n"; 
$browser->get('/profile/index')->
  isStatusCode(200)->
  isRequestParameter('module', 'profile')->
  isRequestParameter('action', 'index');

echo "\n"."Probando la accion list del modulo perfil de jugador"."\n";
$browser->get('/profile/list')->
  isStatusCode(200)->
  isRequestParameter('module', 'profile')->
  isRequestParameter('action', 'list');

echo "\n"."Probando la accion show del modulo perfil de jugador"."\n";
$browser->get('/profile/show/username/prueba')->
  isStatusCode(200)->
  isRequestParameter('module', 'profile')->
  isRequestParameter('action', 'show');
  
$browser->get('/profile/show/username/prueba')->
    isRequestParameter('username', "prueba")->
    isStatusCode()->
    isResponseHeader('content-type', 'text/html; charset=utf-8')->
    responseContains('show');
  
echo "\n"."Probando la accion addFriend del modulo perfil de jugador"."\n";  
$browser->get('/profile/addFriend/id/4')->
  isStatusCode(302)->
  isRequestParameter('module', 'profile')->
  isRequestParameter('action', 'addFriend');
  
echo "\n"."Probando la accion acceptFriend del modulo perfil de jugador"."\n";  
$browser->get('/profile/acceptFriend/id/4')->
  isStatusCode(302)->
  isRequestParameter('module', 'profile')->
  isRequestParameter('action', 'acceptFriend');
  
echo "\n"."Probando la accion rejectFriend del modulo perfil de jugador"."\n";  
$browser->get('/profile/rejectFriend/id/4')->
  isStatusCode(302)->
  isRequestParameter('module', 'profile')->
  isRequestParameter('action', 'rejectFriend');
