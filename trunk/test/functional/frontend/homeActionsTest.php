<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."Nos identificamos como el usuario Prueba"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'prueba@prueba.com', 'password' => 'prueba'))->
  isStatusCode(302);

echo "\n"."Probando la accion index del modulo home"."\n"; 
$browser->get('/home/index')->
  isStatusCode(200)->
  isRequestParameter('module', 'home')->
  isRequestParameter('action', 'index');

echo "\n"."Probando la accion welcome del modulo home"."\n";
$browser->get('/home/welcome')->
  isStatusCode(200)->
  isRequestParameter('module', 'home')->
  isRequestParameter('action', 'welcome');

echo "\n"."Probando la accion emailApproved del modulo home"."\n";
$browser->get('/home/emailApproved')->
  isStatusCode(302)->
  isRequestParameter('module', 'home')->
  isRequestParameter('action', 'emailApproved');
    
echo "\n"."Probando la accion approveEmail del modulo home"."\n";    
$browser->get('/home/approveEmail')->
  isStatusCode(200)->
  isRequestParameter('module', 'home')->
  isRequestParameter('action', 'approveEmail');
