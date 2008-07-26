<?php


abstract class BaseAvatar_Item extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_avatar;


	
	protected $id_item;


	
	protected $active;

	
	protected $aItem;

	
	protected $aAvatar;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdAvatar()
	{

		return $this->id_avatar;
	}

	
	public function getIdItem()
	{

		return $this->id_item;
	}

	
	public function getActive()
	{

		return $this->active;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Avatar_ItemPeer::ID;
		}

	} 
	
	public function setIdAvatar($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_avatar !== $v) {
			$this->id_avatar = $v;
			$this->modifiedColumns[] = Avatar_ItemPeer::ID_AVATAR;
		}

		if ($this->aAvatar !== null && $this->aAvatar->getId() !== $v) {
			$this->aAvatar = null;
		}

	} 
	
	public function setIdItem($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_item !== $v) {
			$this->id_item = $v;
			$this->modifiedColumns[] = Avatar_ItemPeer::ID_ITEM;
		}

		if ($this->aItem !== null && $this->aItem->getId() !== $v) {
			$this->aItem = null;
		}

	} 
	
	public function setActive($v)
	{

		if ($this->active !== $v) {
			$this->active = $v;
			$this->modifiedColumns[] = Avatar_ItemPeer::ACTIVE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->id_avatar = $rs->getInt($startcol + 1);

			$this->id_item = $rs->getInt($startcol + 2);

			$this->active = $rs->getBoolean($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Avatar_Item object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatar_Item:delete:pre') as $callable)
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
			$con = Propel::getConnection(Avatar_ItemPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Avatar_ItemPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAvatar_Item:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatar_Item:save:pre') as $callable)
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
			$con = Propel::getConnection(Avatar_ItemPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAvatar_Item:save:post') as $callable)
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


												
			if ($this->aItem !== null) {
				if ($this->aItem->isModified()) {
					$affectedRows += $this->aItem->save($con);
				}
				$this->setItem($this->aItem);
			}

			if ($this->aAvatar !== null) {
				if ($this->aAvatar->isModified()) {
					$affectedRows += $this->aAvatar->save($con);
				}
				$this->setAvatar($this->aAvatar);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Avatar_ItemPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Avatar_ItemPeer::doUpdate($this, $con);
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


												
			if ($this->aItem !== null) {
				if (!$this->aItem->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aItem->getValidationFailures());
				}
			}

			if ($this->aAvatar !== null) {
				if (!$this->aAvatar->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAvatar->getValidationFailures());
				}
			}


			if (($retval = Avatar_ItemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Avatar_ItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdAvatar();
				break;
			case 2:
				return $this->getIdItem();
				break;
			case 3:
				return $this->getActive();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Avatar_ItemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdAvatar(),
			$keys[2] => $this->getIdItem(),
			$keys[3] => $this->getActive(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Avatar_ItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdAvatar($value);
				break;
			case 2:
				$this->setIdItem($value);
				break;
			case 3:
				$this->setActive($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Avatar_ItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdAvatar($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdItem($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setActive($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Avatar_ItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(Avatar_ItemPeer::ID)) $criteria->add(Avatar_ItemPeer::ID, $this->id);
		if ($this->isColumnModified(Avatar_ItemPeer::ID_AVATAR)) $criteria->add(Avatar_ItemPeer::ID_AVATAR, $this->id_avatar);
		if ($this->isColumnModified(Avatar_ItemPeer::ID_ITEM)) $criteria->add(Avatar_ItemPeer::ID_ITEM, $this->id_item);
		if ($this->isColumnModified(Avatar_ItemPeer::ACTIVE)) $criteria->add(Avatar_ItemPeer::ACTIVE, $this->active);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Avatar_ItemPeer::DATABASE_NAME);

		$criteria->add(Avatar_ItemPeer::ID, $this->id);

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

		$copyObj->setIdAvatar($this->id_avatar);

		$copyObj->setIdItem($this->id_item);

		$copyObj->setActive($this->active);


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
			self::$peer = new Avatar_ItemPeer();
		}
		return self::$peer;
	}

	
	public function setItem($v)
	{


		if ($v === null) {
			$this->setIdItem(NULL);
		} else {
			$this->setIdItem($v->getId());
		}


		$this->aItem = $v;
	}


	
	public function getItem($con = null)
	{
		if ($this->aItem === null && ($this->id_item !== null)) {
						include_once 'lib/model/om/BaseItemPeer.php';

			$this->aItem = ItemPeer::retrieveByPK($this->id_item, $con);

			
		}
		return $this->aItem;
	}

	
	public function setAvatar($v)
	{


		if ($v === null) {
			$this->setIdAvatar(NULL);
		} else {
			$this->setIdAvatar($v->getId());
		}


		$this->aAvatar = $v;
	}


	
	public function getAvatar($con = null)
	{
		if ($this->aAvatar === null && ($this->id_avatar !== null)) {
						include_once 'lib/model/om/BaseAvatarPeer.php';

			$this->aAvatar = AvatarPeer::retrieveByPK($this->id_avatar, $con);

			
		}
		return $this->aAvatar;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAvatar_Item:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAvatar_Item::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 