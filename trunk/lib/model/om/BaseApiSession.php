<?php


abstract class BaseApiSession extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $session_id;


	
	protected $avatar_apikey;


	
	protected $api_key;


	
	protected $privileges_level;


	
	protected $created_at;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getSessionId()
	{

		return $this->session_id;
	}

	
	public function getAvatarApikey()
	{

		return $this->avatar_apikey;
	}

	
	public function getApiKey()
	{

		return $this->api_key;
	}

	
	public function getPrivilegesLevel()
	{

		return $this->privileges_level;
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
			$this->modifiedColumns[] = ApiSessionPeer::ID;
		}

	} 
	
	public function setSessionId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->session_id !== $v) {
			$this->session_id = $v;
			$this->modifiedColumns[] = ApiSessionPeer::SESSION_ID;
		}

	} 
	
	public function setAvatarApikey($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->avatar_apikey !== $v) {
			$this->avatar_apikey = $v;
			$this->modifiedColumns[] = ApiSessionPeer::AVATAR_APIKEY;
		}

	} 
	
	public function setApiKey($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->api_key !== $v) {
			$this->api_key = $v;
			$this->modifiedColumns[] = ApiSessionPeer::API_KEY;
		}

	} 
	
	public function setPrivilegesLevel($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->privileges_level !== $v) {
			$this->privileges_level = $v;
			$this->modifiedColumns[] = ApiSessionPeer::PRIVILEGES_LEVEL;
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
			$this->modifiedColumns[] = ApiSessionPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->session_id = $rs->getString($startcol + 1);

			$this->avatar_apikey = $rs->getString($startcol + 2);

			$this->api_key = $rs->getString($startcol + 3);

			$this->privileges_level = $rs->getInt($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ApiSession object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseApiSession:delete:pre') as $callable)
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
			$con = Propel::getConnection(ApiSessionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ApiSessionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseApiSession:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseApiSession:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ApiSessionPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ApiSessionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseApiSession:save:post') as $callable)
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ApiSessionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ApiSessionPeer::doUpdate($this, $con);
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


			if (($retval = ApiSessionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ApiSessionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getSessionId();
				break;
			case 2:
				return $this->getAvatarApikey();
				break;
			case 3:
				return $this->getApiKey();
				break;
			case 4:
				return $this->getPrivilegesLevel();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ApiSessionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getSessionId(),
			$keys[2] => $this->getAvatarApikey(),
			$keys[3] => $this->getApiKey(),
			$keys[4] => $this->getPrivilegesLevel(),
			$keys[5] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ApiSessionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setSessionId($value);
				break;
			case 2:
				$this->setAvatarApikey($value);
				break;
			case 3:
				$this->setApiKey($value);
				break;
			case 4:
				$this->setPrivilegesLevel($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ApiSessionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSessionId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAvatarApikey($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setApiKey($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPrivilegesLevel($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ApiSessionPeer::DATABASE_NAME);

		if ($this->isColumnModified(ApiSessionPeer::ID)) $criteria->add(ApiSessionPeer::ID, $this->id);
		if ($this->isColumnModified(ApiSessionPeer::SESSION_ID)) $criteria->add(ApiSessionPeer::SESSION_ID, $this->session_id);
		if ($this->isColumnModified(ApiSessionPeer::AVATAR_APIKEY)) $criteria->add(ApiSessionPeer::AVATAR_APIKEY, $this->avatar_apikey);
		if ($this->isColumnModified(ApiSessionPeer::API_KEY)) $criteria->add(ApiSessionPeer::API_KEY, $this->api_key);
		if ($this->isColumnModified(ApiSessionPeer::PRIVILEGES_LEVEL)) $criteria->add(ApiSessionPeer::PRIVILEGES_LEVEL, $this->privileges_level);
		if ($this->isColumnModified(ApiSessionPeer::CREATED_AT)) $criteria->add(ApiSessionPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ApiSessionPeer::DATABASE_NAME);

		$criteria->add(ApiSessionPeer::ID, $this->id);

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

		$copyObj->setSessionId($this->session_id);

		$copyObj->setAvatarApikey($this->avatar_apikey);

		$copyObj->setApiKey($this->api_key);

		$copyObj->setPrivilegesLevel($this->privileges_level);

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
			self::$peer = new ApiSessionPeer();
		}
		return self::$peer;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseApiSession:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseApiSession::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 