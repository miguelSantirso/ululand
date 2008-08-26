<?php

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Pncil.com
 * @version    SVN: $Id$
 */
class ulCustomFilter extends sfFilter
{
	public function execute ($filterChain)
	{
		if ($this->isFirstCall())
		{
			if(!$this->context->getUser()->isAuthenticated())
			{
				if ($cookie = $this->context->getRequest()->getCookie(sfConfig::get('app_sf_guard_plugin_remember_cookie_name', 'sfRemember')))
				{
					$c = new Criteria();
					$c->add(sfGuardRememberKeyPeer::REMEMBER_KEY, $cookie);
					$rk = sfGuardRememberKeyPeer::doSelectOne($c);
					if ($rk && $rk->getSfGuardUser())
					{
						$this->getContext()->getUser()->signIn($rk->getSfGuardUser());
					}
				}
				
				// @todo: refactorizar
				$languages = $this->context->getRequest()->getLanguages();
				$preferredLanguage = $languages[0];
				if($preferredLanguage == 'es' || $preferredLanguage == 'es_ES')
					$this->context->getUser()->setCulture('es');
				else
					$this->context->getUser()->setCulture('en');
			}
			
		}

		$filterChain->execute();
	}
}
