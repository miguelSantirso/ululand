<?php

/**
 * Subclass for performing query and update operations on the 'account' table.
 *
 * 
 *
 * @package lib.model
 */ 
class AccountPeer extends BaseAccountPeer
{
	/**
	 * Comprueba si el email y la contraseña pasados como parámetro se corresponden a una cuenta válida.
	 * Además, se retorna la cuenta en caso de existir o null en caso contrario
	 * 
	 * @param $email Email que identifica la cuenta que se desea validar
	 * @param $password Contraseña cuya validez se desea comprobar
	 * 
	 * @return Cuenta asociada, en caso de se correctos los datos. null en caso contrario.
	 */
	public static function getAuthenticatedAccount($email, $password)
	{
		$c = new Criteria();
		$c->add(AccountPeer::EMAIL, $email);
		$account = AccountPeer::doSelectOne($c);

		// Si existe la cuenta
		if ($account)
		{
			// Comprobar que la contraseña es correcta
			$realPassword = $account->getHashedPassword();
			$inputPassword = Account::generateHash($password, $account->getSalt() );
				
			if( $inputPassword == $realPassword )
			{
				return $account;
			}
		}
		return null;
	}
	
	public static function retrieveByUsername($email)
	{
		$c = new Criteria();
		$c->add(AccountPeer::EMAIL, $email);
		return AccountPeer::doSelectOne($c);
	}
}