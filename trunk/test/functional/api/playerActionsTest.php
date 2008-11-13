<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."Nos identificamos como el usuario miguelSantirso"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'tirso.00@gmail.com', 'password' => 'tirsotirso'))->
  isStatusCode(200);

echo "\n"."Probando la accion get del modulo jugador de la api"."\n"; 
$browser->get('/player/get/userUuid/c58e91fb-836f-3734-39c4-a5883cb8e0d6')->
  isStatusCode(200)->
  isRequestParameter('module', 'player')->
  isRequestParameter('action', 'get');
  
echo "\n"."Probando la accion getAvailableCredits del modulo jugador de la api"."\n"; 
$browser->get('/player/getAvailableCredits/userUuid/c58e91fb-836f-3734-39c4-a5883cb8e0d6')->
  isStatusCode(200)->
  isRequestParameter('module', 'player')->
  isRequestParameter('action', 'getAvailableCredits');
  
echo "\n"."Probando la accion substractCredits del modulo jugador de la api"."\n"; 
$browser->get('/player/substractCredits/userUuid/c58e91fb-836f-3734-39c4-a5883cb8e0d6/amount/25')->
  isStatusCode(200)->
  isRequestParameter('module', 'player')->
  isRequestParameter('action', 'substractCredits');