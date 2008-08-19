<?php

/**
 * Subclass for representing a row from the 'account' table.
 *
 *
 *
 * @package lib.model
 */
class Account extends BaseAccount
{
	protected $password;

	/**
	 * getPassword: Funci�n necesaria para la realizaci�n del cambio de contrase�a de un usuario por parte del administrador.
	 *
	 * @return string $this->password Cadena
	 **/
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * setPassword: Funci�n necesaria para la realizaci�n del cambio de contrase�a de un usuario por parte del administrador.
	 * Se recibe la nueva contrase�a introducida por el administrador.
	 * Se comprueba que cumple los requ�sitos, se encripta y se guarda en la base de datos.
	 *
	 * @param string $v Cadena nueva contrase�a introducida por el administrador
	 * @return void
	 **/
	public function setPassword($v)
	{
		if ($v !== null && !is_string($v))
		{
			$v = (string) $v;
		}
		if ($this->password !== $v)
		{
			$this->password = $v;

			// encriptamos todo
			$hashedpassword = Account::generateHash($this->password, $this->getSalt());
			$this->setHashedPassword($hashedpassword);
			$this->save();
		}
	}
	
	public function getAvatar()
	{
		// Obtener la informaci�n necesaria de la base de datos
		$c = new Criteria();
		$c->add( AvatarPeer::ACCOUNT_ID, $this->getId() );
		$avatars = AvatarPeer::doSelect( $c );

		// Obtener los ids de los dos avatares
		return $avatars[0];
	}

	/**
	 * Funci�n que encripta un texto junto con el salt
	 */
	public static function generateHash($plainText, $salt)
	{
		return sha1($salt . $plainText);
	}

	public function getUsername()
	{
		return $this->email;
	}
	
	public function __toString()
	{
		return $this->getEmail();
	}
	
	public function hasPermission()
	{
		return false;
	}
}

sfPropelBehavior::add('Account', 
  array(
    'sfPropelApprovableBehavior' => array(
      'column' => 'is_approved',
      'disabled_applications' => array('backend'),
       'destination' => 'home/EmailApproved'
    )
  )
);