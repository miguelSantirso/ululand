<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."Nos identificamos como el usuario miguelSantirso"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'tirso.00@gmail.com', 'password' => 'tirsotirso'))->
  isStatusCode(200);

echo "\n"."Probando la accion getByUserUuid del modulo avatar de la api"."\n"; 
$browser->get('/avatar/getByUserUuid/userUuid/c58e91fb-836f-3734-39c4-a5883cb8e0d6')->
  isStatusCode(200)->
  isRequestParameter('module', 'avatar')->
  isRequestParameter('action', 'getByUserUuid');
