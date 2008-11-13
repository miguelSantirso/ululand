<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

echo "\n"."Nos identificamos como el usuario Prueba"."\n";
$browser->post('/sfGuardAuth/signin', array('username' => 'prueba@prueba.com', 'password' => 'prueba'))->
  isStatusCode(302);

echo "\n"."Probando la accion index del modulo opciones"."\n"; 
$browser->get('/options/index')->
  isStatusCode(200)->
  isRequestParameter('module', 'options')->
  isRequestParameter('action', 'index');
    
echo "\n"."Probando la accion editProfile del modulo opciones"."\n";    
$browser->get('/options/editProfile/id/2')->
  isStatusCode(200)->
  isRequestParameter('module', 'options')->
  isRequestParameter('action', 'editProfile');// Revisar función getGender
  
echo "\n"."Probando la accion editPassword del modulo opciones"."\n";    
$browser->get('/options/editPassword/password/newPassword')->
  isStatusCode(200)->
  isRequestParameter('module', 'options')->
  isRequestParameter('action', 'editPassword');
  
echo "\n"."Probando la accion editSettings del modulo opciones"."\n";    
$browser->get('/options/editSettings/id/2')->
  isStatusCode(200)->
  isRequestParameter('module', 'options')->
  isRequestParameter('action', 'editSettings');
  
echo "\n"."Probando la accion editAvatar del modulo opciones"."\n";    
$browser->get('/options/editAvatar/id/2')->
  isStatusCode(200)->
  isRequestParameter('module', 'options')->
  isRequestParameter('action', 'editAvatar');
  
echo "\n"."Probando la accion setAvatarPiece del modulo opciones"."\n";    
$browser->get('/options/setAvatarPiece/id/2')->
  isStatusCode(200)->
  isRequestParameter('module', 'options')->
  isRequestParameter('action', 'setAvatarPiece');
