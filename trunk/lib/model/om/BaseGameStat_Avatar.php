<?php


abstract class BaseGameStat_Avatar extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $gamestat_id;


	
	protected $avatar_id;


	
	protected $value;


	
	protected $created_at;

	
	protected $aGameStat;

	
	protected $aAvatar;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getGamestatId()
	{

		return $this->gamestat_id;
	}

	
	public function getAvatarId()
	{

		return $this->avatar_id;
	}

	
	public function getValue()
	{

		return $this->value;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = GameStat_AvatarPeer::ID;
		}

	} 
	
	public function setGamestatId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->gamestat_id !== $v) {
			$this->gamestat_id = $v;
			$this->modifiedColumns[] = GameStat_AvatarPeer::GAMESTAT_ID;
		}

		if ($this->aGameStat !== null && $this->aGameStat->getId() !== $v) {
			$this->aGameStat = null;
		}

	} 
	
	public function setAvatarId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->avatar_id !== $v) {
			$this->avatar_id = $v;
			$this->modifiedColumns[] = GameStat_AvatarPeer::AVATAR_ID;
		}

		if ($this->aAvatar !== null && $this->aAvatar->getId() !== $v) {
			$this->aAvatar = null;
		}

	} 
	
	public function setValue($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->value !== $v) {
			$this->value = $v;
			$this->modifiedColumns[] = GameStat_AvatarPeer::VALUE;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = GameStat_AvatarPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->gamestat_id = $rs->getInt($startcol + 1);

			$this->avatar_id = $rs->getInt($startcol + 2);

			$this->value = $rs->getInt($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating GameStat_Avatar object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseGameStat_Avatar:delete:pre') as $callable)
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
			$con = Propel::getConnection(GameStat_AvatarPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			GameStat_AvatarPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseGameStat_Avatar:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseGameStat_Avatar:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(GameStat_AvatarPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GameStat_AvatarPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseGameStat_Avatar:save:post') as $callable)
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


												
			if ($this->aGameStat !== null) {
				if ($this->aGameStat->isModified()) {
					$affectedRows += $this->aGameStat->save($con);
				}
				$this->setGameStat($this->aGameStat);
			}

			if ($this->aAvatar !== null) {
				if ($this->aAvatar->isModified()) {
					$affectedRows += $this->aAvatar->save($con);
				}
				$this->setAvatar($this->aAvatar);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = GameStat_AvatarPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += GameStat_AvatarPeer::doUpdate($this, $con);
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


												
			if ($this->aGameStat !== null) {
				if (!$this->aGameStat->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aGameStat->getValidationFailures());
				}
			}

			if ($this->aAvatar !== null) {
				if (!$this->aAvatar->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAvatar->getValidationFailures());
				}
			}


			if (($retval = GameStat_AvatarPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GameStat_AvatarPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getGamestatId();
				break;
			case 2:
				return $this->getAvatarId();
				break;
			case 3:
				return $this->getValue();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GameStat_AvatarPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getGamestatId(),
			$keys[2] => $this->getAvatarId(),
			$keys[3] => $this->getValue(),
			$keys[4] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GameStat_AvatarPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setGamestatId($value);
				break;
			case 2:
				$this->setAvatarId($value);
				break;
			case 3:
				$this->setValue($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GameStat_AvatarPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setGamestatId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAvatarId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setValue($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(GameStat_AvatarPeer::DATABASE_NAME);

		if ($this->isColumnModified(GameStat_AvatarPeer::ID)) $criteria->add(GameStat_AvatarPeer::ID, $this->id);
		if ($this->isColumnModified(GameStat_AvatarPeer::GAMESTAT_ID)) $criteria->add(GameStat_AvatarPeer::GAMESTAT_ID, $this->gamestat_id);
		if ($this->isColumnModified(GameStat_AvatarPeer::AVATAR_ID)) $criteria->add(GameStat_AvatarPeer::AVATAR_ID, $this->avatar_id);
		if ($this->isColumnModified(GameStat_AvatarPeer::VALUE)) $criteria->add(GameStat_AvatarPeer::VALUE, $this->value);
		if ($this->isColumnModified(GameStat_AvatarPeer::CREATED_AT)) $criteria->add(GameStat_AvatarPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(GameStat_AvatarPeer::DATABASE_NAME);

		$criteria->add(GameStat_AvatarPeer::ID, $this->id);

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

		$copyObj->setGamestatId($this->gamestat_id);

		$copyObj->setAvatarId($this->avatar_id);

		$copyObj->setValue($this->value);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new GameStat_AvatarPeer();
		}
		return self::$peer;
	}

	
	public function setGameStat($v)
	{


		if ($v === null) {
			$this->setGamestatId(NULL);
		} else {
			$this->setGamestatId($v->getId());
		}


		$this->aGameStat = $v;
	}


	
	public function getGameStat($con = null)
	{
		if ($this->aGameStat === null && ($this->gamestat_id !== null)) {
						include_once 'lib/model/om/BaseGameStatPeer.php';

			$this->aGameStat = GameStatPeer::retrieveByPK($this->gamestat_id, $con);

			
		}
		return $this->aGameStat;
	}

	
	public function setAvatar($v)
	{


		if ($v === null) {
			$this->setAvatarId(NULL);
		} else {
			$this->setAvatarId($v->getId());
		}


		$this->aAvatar = $v;
	}


	
	public function getAvatar($con = null)
	{
		if ($this->aAvatar === null && ($this->avatar_id !== null)) {
						include_once 'lib/model/om/BaseAvatarPeer.php';

			$this->aAvatar = AvatarPeer::retrieveByPK($this->avatar_id, $con);

			
		}
		return $this->aAvatar;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseGameStat_Avatar:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseGameStat_Avatar::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 