<?php

/**
 * @package sfModalBoxPlugin
 *
 * @author Mickael Kurmann <mickael.kurmann@gmail.com>
 * @since  22 Apr 2007
 * @version 1.0.0
 *
 */

/**
 * Enable to use Modalbox script : http://www.wildbit.com/labs/modalbox/
 *
 * *
 * @author Gerald Estadieu <gestadieu@gmail.com>
 * @since  15 Apr 2007
 *
 */
function m_link_to($name, $url, $html_options = array(), $modal_options = array())
{
    use_helper('Javascript');
    
    if(!array_key_exists('title', $html_options))
    {
        $html_options['title'] = $name;
    }
    
    $modal_options = array_merge($modal_options, array('title' => 'this.title'));
    
    $params_to_escape = sfConfig::get('app_params_to_escape_list');
    
    // escape strings for js
    foreach($modal_options as $option => $value)
    {
        if(in_array($option, $params_to_escape))
        {
            $modal_options[$option] = "'" . $value . "'";
        }
    }
    
    $js_options = _options_for_javascript($modal_options);

    $html_options['onclick'] = "Modalbox.show(this.href, " . $js_options . "); return false;";

    return link_to($name, $url, $html_options);
}


function loadRessources()
{
    // Prototype & scriptaculous
    $response = sfContext::getInstance()->getResponse();
    $response->addJavascript(sfConfig::get('sf_prototype_web_dir'). '/js/prototype');
    $response->addJavascript(sfConfig::get('sf_prototype_web_dir'). '/js/scriptaculous');
    $response->addJavascript(sfConfig::get('sf_prototype_web_dir'). '/js/effects');

    $response->addJavascript('/sfModalBoxPlugin/js/modalbox', 'last');
    $response->addStylesheet('/sfModalBoxPlugin/css/modalbox');
}

loadRessources();