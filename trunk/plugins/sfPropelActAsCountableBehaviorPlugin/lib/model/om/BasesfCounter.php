<?php


abstract class BasesfCounter extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $countable_model;


	
	protected $countable_id;


	
	protected $counter = 0;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getID()
	{

		return $this->id;
	}

	
	public function getCountableModel()
	{

		return $this->countable_model;
	}

	
	public function getCountableId()
	{

		return $this->countable_id;
	}

	
	public function getCOUNTER()
	{

		return $this->counter;
	}

	
	public function setID($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = sfCounterPeer::ID;
		}

	} 
	
	public function setCountableModel($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->countable_model !== $v) {
			$this->countable_model = $v;
			$this->modifiedColumns[] = sfCounterPeer::COUNTABLE_MODEL;
		}

	} 
	
	public function setCountableId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->countable_id !== $v) {
			$this->countable_id = $v;
			$this->modifiedColumns[] = sfCounterPeer::COUNTABLE_ID;
		}

	} 
	
	public function setCOUNTER($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->counter !== $v || $v === 0) {
			$this->counter = $v;
			$this->modifiedColumns[] = sfCounterPeer::COUNTER;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->countable_model = $rs->getString($startcol + 1);

			$this->countable_id = $rs->getInt($startcol + 2);

			$this->counter = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating sfCounter object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasesfCounter:delete:pre') as $callable)
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
			$con = Propel::getConnection(sfCounterPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			sfCounterPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasesfCounter:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasesfCounter:save:pre') as $callable)
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
			$con = Propel::getConnection(sfCounterPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasesfCounter:save:post') as $callable)
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
					$pk = sfCounterPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setID($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += sfCounterPeer::doUpdate($this, $con);
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


			if (($retval = sfCounterPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfCounterPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getID();
				break;
			case 1:
				return $this->getCountableModel();
				break;
			case 2:
				return $this->getCountableId();
				break;
			case 3:
				return $this->getCOUNTER();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfCounterPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getID(),
			$keys[1] => $this->getCountableModel(),
			$keys[2] => $this->getCountableId(),
			$keys[3] => $this->getCOUNTER(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfCounterPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setID($value);
				break;
			case 1:
				$this->setCountableModel($value);
				break;
			case 2:
				$this->setCountableId($value);
				break;
			case 3:
				$this->setCOUNTER($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfCounterPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setID($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCountableModel($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCountableId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCOUNTER($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(sfCounterPeer::DATABASE_NAME);

		if ($this->isColumnModified(sfCounterPeer::ID)) $criteria->add(sfCounterPeer::ID, $this->id);
		if ($this->isColumnModified(sfCounterPeer::COUNTABLE_MODEL)) $criteria->add(sfCounterPeer::COUNTABLE_MODEL, $this->countable_model);
		if ($this->isColumnModified(sfCounterPeer::COUNTABLE_ID)) $criteria->add(sfCounterPeer::COUNTABLE_ID, $this->countable_id);
		if ($this->isColumnModified(sfCounterPeer::COUNTER)) $criteria->add(sfCounterPeer::COUNTER, $this->counter);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(sfCounterPeer::DATABASE_NAME);

		$criteria->add(sfCounterPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getID();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setID($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCountableModel($this->countable_model);

		$copyObj->setCountableId($this->countable_id);

		$copyObj->setCOUNTER($this->counter);


		$copyObj->setNew(true);

		$copyObj->setID(NULL); 
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
			self::$peer = new sfCounterPeer();
		}
		return self::$peer;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasesfCounter:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasesfCounter::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 