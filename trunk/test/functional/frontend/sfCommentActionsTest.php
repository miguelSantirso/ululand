<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."Nos identificamos como el usuario Prueba"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'prueba@prueba.com', 'password' => 'prueba'))->
  isStatusCode(302);

echo "\n"."Probando la accion remove del modulo comentario"."\n"; 
$browser->get('/sfComment/remove/id/2')->
  isStatusCode(200)->
  isRequestParameter('module', 'sfComment')->
  isRequestParameter('action', 'remove');
