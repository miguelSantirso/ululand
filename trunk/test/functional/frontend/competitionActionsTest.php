<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."Nos identificamos como el usuario Prueba"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'prueba@prueba.com', 'password' => 'prueba'))->
  isStatusCode(302);

echo "\n"."Probando la accion index del modulo competicion"."\n"; 
$browser->get('/competition/index')->
  isStatusCode(200)->
  isRequestParameter('module', 'competition')->
  isRequestParameter('action', 'index');

echo "\n"."Probando la accion list del modulo competicion"."\n";
$browser->get('/competition/list')->
  isStatusCode(200)->
  isRequestParameter('module', 'competition')->
  isRequestParameter('action', 'list');

echo "\n"."Probando la accion show del modulo competicion"."\n";
$browser->get('/competition/show/id/1')->
  isStatusCode(200)->
  isRequestParameter('module', 'competition')->
  isRequestParameter('action', 'show');
  
$browser->get('/competition/show/id/1')->
    isRequestParameter('id', 1)->
    isStatusCode()->
    isResponseHeader('content-type', 'text/html; charset=utf-8')->
    responseContains('show');
    
echo "\n"."Probando la accion edit del modulo competicion"."\n";    
$browser->get('/competition/edit/id/1')->
  isStatusCode(200)->
  isRequestParameter('module', 'competition')->
  isRequestParameter('action', 'edit');
  
echo "\n"."Probando la accion update del modulo competicion"."\n";  
$browser->get('/competition/update/id/1/name/Competition1/description/Cambio')->
  isStatusCode(200)->
  isRequestParameter('module', 'competition')->
  isRequestParameter('action', 'update');
  
echo "\n"."Probando la accion preview del modulo competicion"."\n";  
$browser->get('/competition/preview/name/Competition1/description/Cambio')->
  isStatusCode(200)->
  isRequestParameter('module', 'competition')->
  isRequestParameter('action', 'preview');
  
echo "\n"."Probando la accion union del modulo competicion"."\n";  
$browser->get('/competition/union/competition/1')->
  isStatusCode(302)->
  isRequestParameter('module', 'competition')->
  isRequestParameter('action', 'union');
  
echo "\n"."Probando la accion accept del modulo competicion"."\n";  
$browser->get('/competition/accept/competition/1/player/Prueba')->
  isStatusCode(302)->
  isRequestParameter('module', 'competition')->
  isRequestParameter('action', 'accept');
  
echo "\n"."Probando la accion reject del modulo competicion"."\n";  
$browser->get('/competition/reject/competition/1/player/Prueba')->
  isStatusCode(302)->
  isRequestParameter('module', 'competition')->
  isRequestParameter('action', 'reject');
  
echo "\n"."Probando la accion makeOwner del modulo competicion"."\n";  
$browser->get('/competition/makeOwner/competition/1/player/Prueba')->
  isStatusCode(302)->
  isRequestParameter('module', 'competition')->
  isRequestParameter('action', 'makeOwner');

