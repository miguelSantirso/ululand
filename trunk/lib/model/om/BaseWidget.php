<?php


abstract class BaseWidget extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $privileges_level = 2;


	
	protected $api_key;


	
	protected $name;


	
	protected $description;


	
	protected $url;


	
	protected $width;


	
	protected $height;


	
	protected $bgcolor;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPrivilegesLevel()
	{

		return $this->privileges_level;
	}

	
	public function getApiKey()
	{

		return $this->api_key;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getUrl()
	{

		return $this->url;
	}

	
	public function getWidth()
	{

		return $this->width;
	}

	
	public function getHeight()
	{

		return $this->height;
	}

	
	public function getBgcolor()
	{

		return $this->bgcolor;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WidgetPeer::ID;
		}

	} 
	
	public function setPrivilegesLevel($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->privileges_level !== $v || $v === 2) {
			$this->privileges_level = $v;
			$this->modifiedColumns[] = WidgetPeer::PRIVILEGES_LEVEL;
		}

	} 
	
	public function setApiKey($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->api_key !== $v) {
			$this->api_key = $v;
			$this->modifiedColumns[] = WidgetPeer::API_KEY;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = WidgetPeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = WidgetPeer::DESCRIPTION;
		}

	} 
	
	public function setUrl($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = WidgetPeer::URL;
		}

	} 
	
	public function setWidth($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->width !== $v) {
			$this->width = $v;
			$this->modifiedColumns[] = WidgetPeer::WIDTH;
		}

	} 
	
	public function setHeight($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->height !== $v) {
			$this->height = $v;
			$this->modifiedColumns[] = WidgetPeer::HEIGHT;
		}

	} 
	
	public function setBgcolor($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->bgcolor !== $v) {
			$this->bgcolor = $v;
			$this->modifiedColumns[] = WidgetPeer::BGCOLOR;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->privileges_level = $rs->getInt($startcol + 1);

			$this->api_key = $rs->getString($startcol + 2);

			$this->name = $rs->getString($startcol + 3);

			$this->description = $rs->getString($startcol + 4);

			$this->url = $rs->getString($startcol + 5);

			$this->width = $rs->getInt($startcol + 6);

			$this->height = $rs->getInt($startcol + 7);

			$this->bgcolor = $rs->getString($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Widget object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseWidget:delete:pre') as $callable)
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
			$con = Propel::getConnection(WidgetPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			WidgetPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseWidget:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseWidget:save:pre') as $callable)
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
			$con = Propel::getConnection(WidgetPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseWidget:save:post') as $callable)
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
					$pk = WidgetPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WidgetPeer::doUpdate($this, $con);
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


			if (($retval = WidgetPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WidgetPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPrivilegesLevel();
				break;
			case 2:
				return $this->getApiKey();
				break;
			case 3:
				return $this->getName();
				break;
			case 4:
				return $this->getDescription();
				break;
			case 5:
				return $this->getUrl();
				break;
			case 6:
				return $this->getWidth();
				break;
			case 7:
				return $this->getHeight();
				break;
			case 8:
				return $this->getBgcolor();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WidgetPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPrivilegesLevel(),
			$keys[2] => $this->getApiKey(),
			$keys[3] => $this->getName(),
			$keys[4] => $this->getDescription(),
			$keys[5] => $this->getUrl(),
			$keys[6] => $this->getWidth(),
			$keys[7] => $this->getHeight(),
			$keys[8] => $this->getBgcolor(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WidgetPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPrivilegesLevel($value);
				break;
			case 2:
				$this->setApiKey($value);
				break;
			case 3:
				$this->setName($value);
				break;
			case 4:
				$this->setDescription($value);
				break;
			case 5:
				$this->setUrl($value);
				break;
			case 6:
				$this->setWidth($value);
				break;
			case 7:
				$this->setHeight($value);
				break;
			case 8:
				$this->setBgcolor($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WidgetPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPrivilegesLevel($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setApiKey($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDescription($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUrl($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setWidth($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setHeight($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setBgcolor($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WidgetPeer::DATABASE_NAME);

		if ($this->isColumnModified(WidgetPeer::ID)) $criteria->add(WidgetPeer::ID, $this->id);
		if ($this->isColumnModified(WidgetPeer::PRIVILEGES_LEVEL)) $criteria->add(WidgetPeer::PRIVILEGES_LEVEL, $this->privileges_level);
		if ($this->isColumnModified(WidgetPeer::API_KEY)) $criteria->add(WidgetPeer::API_KEY, $this->api_key);
		if ($this->isColumnModified(WidgetPeer::NAME)) $criteria->add(WidgetPeer::NAME, $this->name);
		if ($this->isColumnModified(WidgetPeer::DESCRIPTION)) $criteria->add(WidgetPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(WidgetPeer::URL)) $criteria->add(WidgetPeer::URL, $this->url);
		if ($this->isColumnModified(WidgetPeer::WIDTH)) $criteria->add(WidgetPeer::WIDTH, $this->width);
		if ($this->isColumnModified(WidgetPeer::HEIGHT)) $criteria->add(WidgetPeer::HEIGHT, $this->height);
		if ($this->isColumnModified(WidgetPeer::BGCOLOR)) $criteria->add(WidgetPeer::BGCOLOR, $this->bgcolor);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WidgetPeer::DATABASE_NAME);

		$criteria->add(WidgetPeer::ID, $this->id);

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

		$copyObj->setPrivilegesLevel($this->privileges_level);

		$copyObj->setApiKey($this->api_key);

		$copyObj->setName($this->name);

		$copyObj->setDescription($this->description);

		$copyObj->setUrl($this->url);

		$copyObj->setWidth($this->width);

		$copyObj->setHeight($this->height);

		$copyObj->setBgcolor($this->bgcolor);


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
			self::$peer = new WidgetPeer();
		}
		return self::$peer;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseWidget:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseWidget::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 