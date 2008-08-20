<?php
// define the standard symfony environment constants
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       false);

// get the domain's parts
list($tld, $domain, $subdomain, $subdomain2) = array_reverse(explode('.', $_SERVER['HTTP_HOST']));

// determine which subdomain we're looking at
$app = $subdomain;
$app = (empty($app) || $app == 'www' ) ? 'developers' : $app;

// determine which app to load based on subdomain
if (!is_dir(SF_ROOT_DIR.'/apps/'.$app))
{
    define('SF_APP','developers');
}
else
{
    define('SF_APP',$app);
    define('SF_APP','developers');
}

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

sfContext::getInstance()->getController()->dispatch();
