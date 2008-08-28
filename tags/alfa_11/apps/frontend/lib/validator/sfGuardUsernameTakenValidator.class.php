<?php
class sfGuardUsernameTakenValidator extends sfValidator
{
	public function initialize($context, $parameters = null)
	{
		// initialize parent
		parent::initialize($context);
		$this->getParameterHolder()->add($parameters);
		return true;
	}
	public function execute(&$value, &$error)
	{
		$desiredUsername = $value;

		$c = new Criteria();
		$c->add(sfGuardUserPeer::USERNAME, $desiredUsername);

		$records = sfGuardUserPeer::doSelect($c);

		if(count($records) == 0){
			return true;
		}else{
			$error = $this->getParameter("msg");
			return false;
		}
	}
}