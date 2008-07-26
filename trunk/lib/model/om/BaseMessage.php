<?php


abstract class BaseMessage extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_sender;


	
	protected $id_recipient;


	
	protected $text;


	
	protected $created_at;

	
	protected $aAvatarRelatedByIdSender;

	
	protected $aAvatarRelatedByIdRecipient;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdSender()
	{

		return $this->id_sender;
	}

	
	public function getIdRecipient()
	{

		return $this->id_recipient;
	}

	
	public function getText()
	{

		return $this->text;
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
			$this->modifiedColumns[] = MessagePeer::ID;
		}

	} 
	
	public function setIdSender($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_sender !== $v) {
			$this->id_sender = $v;
			$this->modifiedColumns[] = MessagePeer::ID_SENDER;
		}

		if ($this->aAvatarRelatedByIdSender !== null && $this->aAvatarRelatedByIdSender->getId() !== $v) {
			$this->aAvatarRelatedByIdSender = null;
		}

	} 
	
	public function setIdRecipient($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_recipient !== $v) {
			$this->id_recipient = $v;
			$this->modifiedColumns[] = MessagePeer::ID_RECIPIENT;
		}

		if ($this->aAvatarRelatedByIdRecipient !== null && $this->aAvatarRelatedByIdRecipient->getId() !== $v) {
			$this->aAvatarRelatedByIdRecipient = null;
		}

	} 
	
	public function setText($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->text !== $v) {
			$this->text = $v;
			$this->modifiedColumns[] = MessagePeer::TEXT;
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
			$this->modifiedColumns[] = MessagePeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->id_sender = $rs->getInt($startcol + 1);

			$this->id_recipient = $rs->getInt($startcol + 2);

			$this->text = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Message object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseMessage:delete:pre') as $callable)
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
			$con = Propel::getConnection(MessagePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MessagePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseMessage:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseMessage:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(MessagePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MessagePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseMessage:save:post') as $callable)
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


												
			if ($this->aAvatarRelatedByIdSender !== null) {
				if ($this->aAvatarRelatedByIdSender->isModified()) {
					$affectedRows += $this->aAvatarRelatedByIdSender->save($con);
				}
				$this->setAvatarRelatedByIdSender($this->aAvatarRelatedByIdSender);
			}

			if ($this->aAvatarRelatedByIdRecipient !== null) {
				if ($this->aAvatarRelatedByIdRecipient->isModified()) {
					$affectedRows += $this->aAvatarRelatedByIdRecipient->save($con);
				}
				$this->setAvatarRelatedByIdRecipient($this->aAvatarRelatedByIdRecipient);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = MessagePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += MessagePeer::doUpdate($this, $con);
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


												
			if ($this->aAvatarRelatedByIdSender !== null) {
				if (!$this->aAvatarRelatedByIdSender->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAvatarRelatedByIdSender->getValidationFailures());
				}
			}

			if ($this->aAvatarRelatedByIdRecipient !== null) {
				if (!$this->aAvatarRelatedByIdRecipient->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAvatarRelatedByIdRecipient->getValidationFailures());
				}
			}


			if (($retval = MessagePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MessagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdSender();
				break;
			case 2:
				return $this->getIdRecipient();
				break;
			case 3:
				return $this->getText();
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
		$keys = MessagePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdSender(),
			$keys[2] => $this->getIdRecipient(),
			$keys[3] => $this->getText(),
			$keys[4] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MessagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdSender($value);
				break;
			case 2:
				$this->setIdRecipient($value);
				break;
			case 3:
				$this->setText($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MessagePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdSender($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdRecipient($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setText($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MessagePeer::DATABASE_NAME);

		if ($this->isColumnModified(MessagePeer::ID)) $criteria->add(MessagePeer::ID, $this->id);
		if ($this->isColumnModified(MessagePeer::ID_SENDER)) $criteria->add(MessagePeer::ID_SENDER, $this->id_sender);
		if ($this->isColumnModified(MessagePeer::ID_RECIPIENT)) $criteria->add(MessagePeer::ID_RECIPIENT, $this->id_recipient);
		if ($this->isColumnModified(MessagePeer::TEXT)) $criteria->add(MessagePeer::TEXT, $this->text);
		if ($this->isColumnModified(MessagePeer::CREATED_AT)) $criteria->add(MessagePeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MessagePeer::DATABASE_NAME);

		$criteria->add(MessagePeer::ID, $this->id);

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

		$copyObj->setIdSender($this->id_sender);

		$copyObj->setIdRecipient($this->id_recipient);

		$copyObj->setText($this->text);

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
			self::$peer = new MessagePeer();
		}
		return self::$peer;
	}

	
	public function setAvatarRelatedByIdSender($v)
	{


		if ($v === null) {
			$this->setIdSender(NULL);
		} else {
			$this->setIdSender($v->getId());
		}


		$this->aAvatarRelatedByIdSender = $v;
	}


	
	public function getAvatarRelatedByIdSender($con = null)
	{
		if ($this->aAvatarRelatedByIdSender === null && ($this->id_sender !== null)) {
						include_once 'lib/model/om/BaseAvatarPeer.php';

			$this->aAvatarRelatedByIdSender = AvatarPeer::retrieveByPK($this->id_sender, $con);

			
		}
		return $this->aAvatarRelatedByIdSender;
	}

	
	public function setAvatarRelatedByIdRecipient($v)
	{


		if ($v === null) {
			$this->setIdRecipient(NULL);
		} else {
			$this->setIdRecipient($v->getId());
		}


		$this->aAvatarRelatedByIdRecipient = $v;
	}


	
	public function getAvatarRelatedByIdRecipient($con = null)
	{
		if ($this->aAvatarRelatedByIdRecipient === null && ($this->id_recipient !== null)) {
						include_once 'lib/model/om/BaseAvatarPeer.php';

			$this->aAvatarRelatedByIdRecipient = AvatarPeer::retrieveByPK($this->id_recipient, $con);

			
		}
		return $this->aAvatarRelatedByIdRecipient;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseMessage:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseMessage::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 