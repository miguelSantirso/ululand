<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();



echo "\n"."Probando la accion register del modulo usuario"."\n"; 
$browser->get('/sfGuardAuth/register/username/Usuario/password/Password')->
  isStatusCode(200)->
  isRequestParameter('module', 'sfGuardAuth')->
  isRequestParameter('action', 'register');

echo "\n"."Nos identificamos como el usuario Prueba"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'prueba@prueba.com', 'password' => 'prueba'))->
  isStatusCode(302);
  
echo "\n"."Probando la accion register del modulo usuario cuando el usuario ya está identificado"."\n";
$browser->get('/sfGuardAuth/register')->
  isStatusCode(302)->
  isRequestParameter('module', 'sfGuardAuth')->
  isRequestParameter('action', 'register');
