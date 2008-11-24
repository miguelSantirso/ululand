<?php

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     pncil.com <http://pncil.com>
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
						$this->context->getUser()->signIn($rk->getSfGuardUser());
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
