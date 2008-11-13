<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."Nos identificamos como el usuario miguelSantirso"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'tirso.00@gmail.com', 'password' => 'tirsotirso'))->
  isStatusCode(200);

echo "\n"."Probando la accion index del modulo gamestat de la api"."\n"; 
$browser->get('/gamestat/index')->
  isStatusCode(200)->
  isRequestParameter('module', 'gamestat')->
  isRequestParameter('action', 'index');
  
echo "\n"."Probando la accion getValue del modulo gamestat de la api"."\n";
$browser->get('/gamestat/getValue/gameUuid/23b35510-965f-79d4-9d09-9b402819eac0/userUuid/c58e91fb-836f-3734-39c4-a5883cb8e0d6/gamestatName/TotalBlocksDestroyed')->
  isStatusCode(200)->
  isRequestParameter('module', 'gamestat')->
  isRequestParameter('action', 'getValue'); //Peer


echo "\n"."Probando la accion setValue del modulo gamestat de la api"."\n";
$browser->get('/gamestat/setValue/userUuid/c58e91fb-836f-3734-39c4-a5883cb8e0d6/gamestatName/TotalBlocksDestroyed/value/50')->
  isStatusCode(200)->
  isRequestParameter('module', 'gamestat')->
  isRequestParameter('action', 'setValue');
