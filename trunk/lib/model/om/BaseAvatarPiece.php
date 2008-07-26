<?php


abstract class BaseAvatarPiece extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $description;


	
	protected $author_id;


	
	protected $owner_id;


	
	protected $url;


	
	protected $price = 0;


	
	protected $type;


	
	protected $in_use = false;


	
	protected $created_at;

	
	protected $aAvatarRelatedByAuthorId;

	
	protected $aAvatarRelatedByOwnerId;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getAuthorId()
	{

		return $this->author_id;
	}

	
	public function getOwnerId()
	{

		return $this->owner_id;
	}

	
	public function getUrl()
	{

		return $this->url;
	}

	
	public function getPrice()
	{

		return $this->price;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getInUse()
	{

		return $this->in_use;
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
			$this->modifiedColumns[] = AvatarPiecePeer::ID;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = AvatarPiecePeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = AvatarPiecePeer::DESCRIPTION;
		}

	} 
	
	public function setAuthorId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->author_id !== $v) {
			$this->author_id = $v;
			$this->modifiedColumns[] = AvatarPiecePeer::AUTHOR_ID;
		}

		if ($this->aAvatarRelatedByAuthorId !== null && $this->aAvatarRelatedByAuthorId->getId() !== $v) {
			$this->aAvatarRelatedByAuthorId = null;
		}

	} 
	
	public function setOwnerId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->owner_id !== $v) {
			$this->owner_id = $v;
			$this->modifiedColumns[] = AvatarPiecePeer::OWNER_ID;
		}

		if ($this->aAvatarRelatedByOwnerId !== null && $this->aAvatarRelatedByOwnerId->getId() !== $v) {
			$this->aAvatarRelatedByOwnerId = null;
		}

	} 
	
	public function setUrl($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = AvatarPiecePeer::URL;
		}

	} 
	
	public function setPrice($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->price !== $v || $v === 0) {
			$this->price = $v;
			$this->modifiedColumns[] = AvatarPiecePeer::PRICE;
		}

	} 
	
	public function setType($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = AvatarPiecePeer::TYPE;
		}

	} 
	
	public function setInUse($v)
	{

		if ($this->in_use !== $v || $v === false) {
			$this->in_use = $v;
			$this->modifiedColumns[] = AvatarPiecePeer::IN_USE;
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
			$this->modifiedColumns[] = AvatarPiecePeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->author_id = $rs->getInt($startcol + 3);

			$this->owner_id = $rs->getInt($startcol + 4);

			$this->url = $rs->getString($startcol + 5);

			$this->price = $rs->getInt($startcol + 6);

			$this->type = $rs->getString($startcol + 7);

			$this->in_use = $rs->getBoolean($startcol + 8);

			$this->created_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating AvatarPiece object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatarPiece:delete:pre') as $callable)
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
			$con = Propel::getConnection(AvatarPiecePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AvatarPiecePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAvatarPiece:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatarPiece:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(AvatarPiecePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AvatarPiecePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAvatarPiece:save:post') as $callable)
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


												
			if ($this->aAvatarRelatedByAuthorId !== null) {
				if ($this->aAvatarRelatedByAuthorId->isModified()) {
					$affectedRows += $this->aAvatarRelatedByAuthorId->save($con);
				}
				$this->setAvatarRelatedByAuthorId($this->aAvatarRelatedByAuthorId);
			}

			if ($this->aAvatarRelatedByOwnerId !== null) {
				if ($this->aAvatarRelatedByOwnerId->isModified()) {
					$affectedRows += $this->aAvatarRelatedByOwnerId->save($con);
				}
				$this->setAvatarRelatedByOwnerId($this->aAvatarRelatedByOwnerId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AvatarPiecePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AvatarPiecePeer::doUpdate($this, $con);
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


												
			if ($this->aAvatarRelatedByAuthorId !== null) {
				if (!$this->aAvatarRelatedByAuthorId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAvatarRelatedByAuthorId->getValidationFailures());
				}
			}

			if ($this->aAvatarRelatedByOwnerId !== null) {
				if (!$this->aAvatarRelatedByOwnerId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAvatarRelatedByOwnerId->getValidationFailures());
				}
			}


			if (($retval = AvatarPiecePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AvatarPiecePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getDescription();
				break;
			case 3:
				return $this->getAuthorId();
				break;
			case 4:
				return $this->getOwnerId();
				break;
			case 5:
				return $this->getUrl();
				break;
			case 6:
				return $this->getPrice();
				break;
			case 7:
				return $this->getType();
				break;
			case 8:
				return $this->getInUse();
				break;
			case 9:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AvatarPiecePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getAuthorId(),
			$keys[4] => $this->getOwnerId(),
			$keys[5] => $this->getUrl(),
			$keys[6] => $this->getPrice(),
			$keys[7] => $this->getType(),
			$keys[8] => $this->getInUse(),
			$keys[9] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AvatarPiecePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
			case 3:
				$this->setAuthorId($value);
				break;
			case 4:
				$this->setOwnerId($value);
				break;
			case 5:
				$this->setUrl($value);
				break;
			case 6:
				$this->setPrice($value);
				break;
			case 7:
				$this->setType($value);
				break;
			case 8:
				$this->setInUse($value);
				break;
			case 9:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AvatarPiecePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAuthorId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setOwnerId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUrl($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPrice($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setType($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setInUse($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AvatarPiecePeer::DATABASE_NAME);

		if ($this->isColumnModified(AvatarPiecePeer::ID)) $criteria->add(AvatarPiecePeer::ID, $this->id);
		if ($this->isColumnModified(AvatarPiecePeer::NAME)) $criteria->add(AvatarPiecePeer::NAME, $this->name);
		if ($this->isColumnModified(AvatarPiecePeer::DESCRIPTION)) $criteria->add(AvatarPiecePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(AvatarPiecePeer::AUTHOR_ID)) $criteria->add(AvatarPiecePeer::AUTHOR_ID, $this->author_id);
		if ($this->isColumnModified(AvatarPiecePeer::OWNER_ID)) $criteria->add(AvatarPiecePeer::OWNER_ID, $this->owner_id);
		if ($this->isColumnModified(AvatarPiecePeer::URL)) $criteria->add(AvatarPiecePeer::URL, $this->url);
		if ($this->isColumnModified(AvatarPiecePeer::PRICE)) $criteria->add(AvatarPiecePeer::PRICE, $this->price);
		if ($this->isColumnModified(AvatarPiecePeer::TYPE)) $criteria->add(AvatarPiecePeer::TYPE, $this->type);
		if ($this->isColumnModified(AvatarPiecePeer::IN_USE)) $criteria->add(AvatarPiecePeer::IN_USE, $this->in_use);
		if ($this->isColumnModified(AvatarPiecePeer::CREATED_AT)) $criteria->add(AvatarPiecePeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AvatarPiecePeer::DATABASE_NAME);

		$criteria->add(AvatarPiecePeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setDescription($this->description);

		$copyObj->setAuthorId($this->author_id);

		$copyObj->setOwnerId($this->owner_id);

		$copyObj->setUrl($this->url);

		$copyObj->setPrice($this->price);

		$copyObj->setType($this->type);

		$copyObj->setInUse($this->in_use);

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
			self::$peer = new AvatarPiecePeer();
		}
		return self::$peer;
	}

	
	public function setAvatarRelatedByAuthorId($v)
	{


		if ($v === null) {
			$this->setAuthorId(NULL);
		} else {
			$this->setAuthorId($v->getId());
		}


		$this->aAvatarRelatedByAuthorId = $v;
	}


	
	public function getAvatarRelatedByAuthorId($con = null)
	{
		if ($this->aAvatarRelatedByAuthorId === null && ($this->author_id !== null)) {
						include_once 'lib/model/om/BaseAvatarPeer.php';

			$this->aAvatarRelatedByAuthorId = AvatarPeer::retrieveByPK($this->author_id, $con);

			
		}
		return $this->aAvatarRelatedByAuthorId;
	}

	
	public function setAvatarRelatedByOwnerId($v)
	{


		if ($v === null) {
			$this->setOwnerId(NULL);
		} else {
			$this->setOwnerId($v->getId());
		}


		$this->aAvatarRelatedByOwnerId = $v;
	}


	
	public function getAvatarRelatedByOwnerId($con = null)
	{
		if ($this->aAvatarRelatedByOwnerId === null && ($this->owner_id !== null)) {
						include_once 'lib/model/om/BaseAvatarPeer.php';

			$this->aAvatarRelatedByOwnerId = AvatarPeer::retrieveByPK($this->owner_id, $con);

			
		}
		return $this->aAvatarRelatedByOwnerId;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAvatarPiece:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAvatarPiece::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 