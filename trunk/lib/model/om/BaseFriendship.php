<?php


abstract class BaseFriendship extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_avatar_a;


	
	protected $a_confirmed = false;


	
	protected $id_avatar_b;


	
	protected $b_confirmed = false;

	
	protected $aAvatarRelatedByIdAvatarA;

	
	protected $aAvatarRelatedByIdAvatarB;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdAvatarA()
	{

		return $this->id_avatar_a;
	}

	
	public function getAConfirmed()
	{

		return $this->a_confirmed;
	}

	
	public function getIdAvatarB()
	{

		return $this->id_avatar_b;
	}

	
	public function getBConfirmed()
	{

		return $this->b_confirmed;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = FriendshipPeer::ID;
		}

	} 
	
	public function setIdAvatarA($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_avatar_a !== $v) {
			$this->id_avatar_a = $v;
			$this->modifiedColumns[] = FriendshipPeer::ID_AVATAR_A;
		}

		if ($this->aAvatarRelatedByIdAvatarA !== null && $this->aAvatarRelatedByIdAvatarA->getId() !== $v) {
			$this->aAvatarRelatedByIdAvatarA = null;
		}

	} 
	
	public function setAConfirmed($v)
	{

		if ($this->a_confirmed !== $v || $v === false) {
			$this->a_confirmed = $v;
			$this->modifiedColumns[] = FriendshipPeer::A_CONFIRMED;
		}

	} 
	
	public function setIdAvatarB($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_avatar_b !== $v) {
			$this->id_avatar_b = $v;
			$this->modifiedColumns[] = FriendshipPeer::ID_AVATAR_B;
		}

		if ($this->aAvatarRelatedByIdAvatarB !== null && $this->aAvatarRelatedByIdAvatarB->getId() !== $v) {
			$this->aAvatarRelatedByIdAvatarB = null;
		}

	} 
	
	public function setBConfirmed($v)
	{

		if ($this->b_confirmed !== $v || $v === false) {
			$this->b_confirmed = $v;
			$this->modifiedColumns[] = FriendshipPeer::B_CONFIRMED;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->id_avatar_a = $rs->getInt($startcol + 1);

			$this->a_confirmed = $rs->getBoolean($startcol + 2);

			$this->id_avatar_b = $rs->getInt($startcol + 3);

			$this->b_confirmed = $rs->getBoolean($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Friendship object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseFriendship:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FriendshipPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FriendshipPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseFriendship:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseFriendship:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FriendshipPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseFriendship:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aAvatarRelatedByIdAvatarA !== null) {
				if ($this->aAvatarRelatedByIdAvatarA->isModified()) {
					$affectedRows += $this->aAvatarRelatedByIdAvatarA->save($con);
				}
				$this->setAvatarRelatedByIdAvatarA($this->aAvatarRelatedByIdAvatarA);
			}

			if ($this->aAvatarRelatedByIdAvatarB !== null) {
				if ($this->aAvatarRelatedByIdAvatarB->isModified()) {
					$affectedRows += $this->aAvatarRelatedByIdAvatarB->save($con);
				}
				$this->setAvatarRelatedByIdAvatarB($this->aAvatarRelatedByIdAvatarB);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FriendshipPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FriendshipPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aAvatarRelatedByIdAvatarA !== null) {
				if (!$this->aAvatarRelatedByIdAvatarA->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAvatarRelatedByIdAvatarA->getValidationFailures());
				}
			}

			if ($this->aAvatarRelatedByIdAvatarB !== null) {
				if (!$this->aAvatarRelatedByIdAvatarB->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAvatarRelatedByIdAvatarB->getValidationFailures());
				}
			}


			if (($retval = FriendshipPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FriendshipPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdAvatarA();
				break;
			case 2:
				return $this->getAConfirmed();
				break;
			case 3:
				return $this->getIdAvatarB();
				break;
			case 4:
				return $this->getBConfirmed();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FriendshipPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdAvatarA(),
			$keys[2] => $this->getAConfirmed(),
			$keys[3] => $this->getIdAvatarB(),
			$keys[4] => $this->getBConfirmed(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FriendshipPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdAvatarA($value);
				break;
			case 2:
				$this->setAConfirmed($value);
				break;
			case 3:
				$this->setIdAvatarB($value);
				break;
			case 4:
				$this->setBConfirmed($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FriendshipPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdAvatarA($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAConfirmed($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIdAvatarB($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setBConfirmed($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FriendshipPeer::DATABASE_NAME);

		if ($this->isColumnModified(FriendshipPeer::ID)) $criteria->add(FriendshipPeer::ID, $this->id);
		if ($this->isColumnModified(FriendshipPeer::ID_AVATAR_A)) $criteria->add(FriendshipPeer::ID_AVATAR_A, $this->id_avatar_a);
		if ($this->isColumnModified(FriendshipPeer::A_CONFIRMED)) $criteria->add(FriendshipPeer::A_CONFIRMED, $this->a_confirmed);
		if ($this->isColumnModified(FriendshipPeer::ID_AVATAR_B)) $criteria->add(FriendshipPeer::ID_AVATAR_B, $this->id_avatar_b);
		if ($this->isColumnModified(FriendshipPeer::B_CONFIRMED)) $criteria->add(FriendshipPeer::B_CONFIRMED, $this->b_confirmed);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FriendshipPeer::DATABASE_NAME);

		$criteria->add(FriendshipPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIdAvatarA($this->id_avatar_a);

		$copyObj->setAConfirmed($this->a_confirmed);

		$copyObj->setIdAvatarB($this->id_avatar_b);

		$copyObj->setBConfirmed($this->b_confirmed);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FriendshipPeer();
		}
		return self::$peer;
	}

	
	public function setAvatarRelatedByIdAvatarA($v)
	{


		if ($v === null) {
			$this->setIdAvatarA(NULL);
		} else {
			$this->setIdAvatarA($v->getId());
		}


		$this->aAvatarRelatedByIdAvatarA = $v;
	}


	
	public function getAvatarRelatedByIdAvatarA($con = null)
	{
		if ($this->aAvatarRelatedByIdAvatarA === null && ($this->id_avatar_a !== null)) {
						include_once 'lib/model/om/BaseAvatarPeer.php';

			$this->aAvatarRelatedByIdAvatarA = AvatarPeer::retrieveByPK($this->id_avatar_a, $con);

			
		}
		return $this->aAvatarRelatedByIdAvatarA;
	}

	
	public function setAvatarRelatedByIdAvatarB($v)
	{


		if ($v === null) {
			$this->setIdAvatarB(NULL);
		} else {
			$this->setIdAvatarB($v->getId());
		}


		$this->aAvatarRelatedByIdAvatarB = $v;
	}


	
	public function getAvatarRelatedByIdAvatarB($con = null)
	{
		if ($this->aAvatarRelatedByIdAvatarB === null && ($this->id_avatar_b !== null)) {
						include_once 'lib/model/om/BaseAvatarPeer.php';

			$this->aAvatarRelatedByIdAvatarB = AvatarPeer::retrieveByPK($this->id_avatar_b, $con);

			
		}
		return $this->aAvatarRelatedByIdAvatarB;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseFriendship:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseFriendship::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 