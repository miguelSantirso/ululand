<?php
##IP_CHECK##
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('developers', 'dev', 1);
sfContext::createInstance($configuration)->dispatch();
