<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."Nos identificamos como el usuario Prueba"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'prueba@prueba.com', 'password' => 'prueba'))->
  isStatusCode(302);

echo "\n"."Probando la accion index del modulo grupo"."\n"; 
$browser->get('/group/index')->
  isStatusCode(200)->
  isRequestParameter('module', 'group')->
  isRequestParameter('action', 'index');

echo "\n"."Probando la accion list del modulo grupo"."\n";
$browser->get('/group/list')->
  isStatusCode(200)->
  isRequestParameter('module', 'group')->
  isRequestParameter('action', 'list');

echo "\n"."Probando la accion show del modulo grupo"."\n";
$browser->get('/group/show/id/1')->
  isStatusCode(200)->
  isRequestParameter('module', 'group')->
  isRequestParameter('action', 'show');
  
$browser->get('/group/show/id/1')->
    isRequestParameter('id', 1)->
    isStatusCode()->
    isResponseHeader('content-type', 'text/html; charset=utf-8')->
    responseContains('show');
    
echo "\n"."Probando la accion edit del modulo grupo"."\n";    
$browser->get('/group/edit/id/1')->
  isStatusCode(200)->
  isRequestParameter('module', 'group')->
  isRequestParameter('action', 'edit');
  
echo "\n"."Probando la accion update del modulo grupo"."\n";  
$browser->get('/group/update/id/1/name/group1/description/Cambio')->
  isStatusCode(200)->
  isRequestParameter('module', 'group')->
  isRequestParameter('action', 'update');
  
echo "\n"."Probando la accion preview del modulo grupo"."\n";  
$browser->get('/group/preview/name/group1/description/Cambio')->
  isStatusCode(200)->
  isRequestParameter('module', 'group')->
  isRequestParameter('action', 'preview');
  
echo "\n"."Probando la accion union del modulo grupo"."\n";  
$browser->get('/group/union/group/1')->
  isStatusCode(302)->
  isRequestParameter('module', 'group')->
  isRequestParameter('action', 'union');
  
echo "\n"."Probando la accion accept del modulo grupo"."\n";  
$browser->get('/group/accept/group/1/player/Prueba')->
  isStatusCode(302)->
  isRequestParameter('module', 'group')->
  isRequestParameter('action', 'accept');
  
echo "\n"."Probando la accion reject del modulo grupo"."\n";  
$browser->get('/group/reject/group/1/player/Prueba')->
  isStatusCode(302)->
  isRequestParameter('module', 'group')->
  isRequestParameter('action', 'reject');
  
echo "\n"."Probando la accion makeOwner del modulo grupo"."\n";  
$browser->get('/group/makeOwner/group/1/player/Prueba')->
  isStatusCode(302)->
  isRequestParameter('module', 'group')->
  isRequestParameter('action', 'makeOwner');

