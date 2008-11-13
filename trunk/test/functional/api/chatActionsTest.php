<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."Nos identificamos como el usuario miguelSantirso"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'tirso.00@gmail.com', 'password' => 'tirsotirso'))->
  isStatusCode(200);

echo "\n"."Probando la accion get del modulo chat de la api"."\n"; 
$browser->get('/chat/login/userUuid/c58e91fb-836f-3734-39c4-a5883cb8e0d6')->
  isStatusCode(200)->
  isRequestParameter('module', 'chat')->
  isRequestParameter('action', 'login');
  
echo "\n"."Probando la accion writeMessage del modulo chat de la api"."\n"; 
$browser->get('/chat/writeMessage/uniqid/c58e91fb-836f-3734-39c4-a5883cb8e0d6/message/Nuevo mensaje en el chat')->
  isStatusCode(200)->
  isRequestParameter('module', 'chat')->
  isRequestParameter('action', 'writeMessage');
  
echo "\n"."Probando la accion readMessages del modulo chat de la api"."\n"; 
$browser->get('/chat/readMessages/uniqid/c58e91fb-836f-3734-39c4-a5883cb8e0d6')->
  isStatusCode(200)->
  isRequestParameter('module', 'chat')->
  isRequestParameter('action', 'readMessages');
