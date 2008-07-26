<?php


abstract class BaseItem extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $gender;


	
	protected $id_itemtype;


	
	protected $url;


	
	protected $description;


	
	protected $price = 0;

	
	protected $aItemType;

	
	protected $collAvatar_Items;

	
	protected $lastAvatar_ItemCriteria = null;

	
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

	
	public function getGender()
	{

		return $this->gender;
	}

	
	public function getIdItemtype()
	{

		return $this->id_itemtype;
	}

	
	public function getUrl()
	{

		return $this->url;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getPrice()
	{

		return $this->price;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ItemPeer::ID;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ItemPeer::NAME;
		}

	} 
	
	public function setGender($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->gender !== $v) {
			$this->gender = $v;
			$this->modifiedColumns[] = ItemPeer::GENDER;
		}

	} 
	
	public function setIdItemtype($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_itemtype !== $v) {
			$this->id_itemtype = $v;
			$this->modifiedColumns[] = ItemPeer::ID_ITEMTYPE;
		}

		if ($this->aItemType !== null && $this->aItemType->getId() !== $v) {
			$this->aItemType = null;
		}

	} 
	
	public function setUrl($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = ItemPeer::URL;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = ItemPeer::DESCRIPTION;
		}

	} 
	
	public function setPrice($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->price !== $v || $v === 0) {
			$this->price = $v;
			$this->modifiedColumns[] = ItemPeer::PRICE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->gender = $rs->getInt($startcol + 2);

			$this->id_itemtype = $rs->getInt($startcol + 3);

			$this->url = $rs->getString($startcol + 4);

			$this->description = $rs->getString($startcol + 5);

			$this->price = $rs->getInt($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Item object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseItem:delete:pre') as $callable)
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
			$con = Propel::getConnection(ItemPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ItemPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseItem:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseItem:save:pre') as $callable)
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
			$con = Propel::getConnection(ItemPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseItem:save:post') as $callable)
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


												
			if ($this->aItemType !== null) {
				if ($this->aItemType->isModified()) {
					$affectedRows += $this->aItemType->save($con);
				}
				$this->setItemType($this->aItemType);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ItemPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ItemPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collAvatar_Items !== null) {
				foreach($this->collAvatar_Items as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


												
			if ($this->aItemType !== null) {
				if (!$this->aItemType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aItemType->getValidationFailures());
				}
			}


			if (($retval = ItemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAvatar_Items !== null) {
					foreach($this->collAvatar_Items as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getGender();
				break;
			case 3:
				return $this->getIdItemtype();
				break;
			case 4:
				return $this->getUrl();
				break;
			case 5:
				return $this->getDescription();
				break;
			case 6:
				return $this->getPrice();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ItemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getGender(),
			$keys[3] => $this->getIdItemtype(),
			$keys[4] => $this->getUrl(),
			$keys[5] => $this->getDescription(),
			$keys[6] => $this->getPrice(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setGender($value);
				break;
			case 3:
				$this->setIdItemtype($value);
				break;
			case 4:
				$this->setUrl($value);
				break;
			case 5:
				$this->setDescription($value);
				break;
			case 6:
				$this->setPrice($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setGender($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIdItemtype($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUrl($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDescription($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPrice($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(ItemPeer::ID)) $criteria->add(ItemPeer::ID, $this->id);
		if ($this->isColumnModified(ItemPeer::NAME)) $criteria->add(ItemPeer::NAME, $this->name);
		if ($this->isColumnModified(ItemPeer::GENDER)) $criteria->add(ItemPeer::GENDER, $this->gender);
		if ($this->isColumnModified(ItemPeer::ID_ITEMTYPE)) $criteria->add(ItemPeer::ID_ITEMTYPE, $this->id_itemtype);
		if ($this->isColumnModified(ItemPeer::URL)) $criteria->add(ItemPeer::URL, $this->url);
		if ($this->isColumnModified(ItemPeer::DESCRIPTION)) $criteria->add(ItemPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(ItemPeer::PRICE)) $criteria->add(ItemPeer::PRICE, $this->price);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ItemPeer::DATABASE_NAME);

		$criteria->add(ItemPeer::ID, $this->id);

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

		$copyObj->setGender($this->gender);

		$copyObj->setIdItemtype($this->id_itemtype);

		$copyObj->setUrl($this->url);

		$copyObj->setDescription($this->description);

		$copyObj->setPrice($this->price);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getAvatar_Items() as $relObj) {
				$copyObj->addAvatar_Item($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new ItemPeer();
		}
		return self::$peer;
	}

	
	public function setItemType($v)
	{


		if ($v === null) {
			$this->setIdItemtype(NULL);
		} else {
			$this->setIdItemtype($v->getId());
		}


		$this->aItemType = $v;
	}


	
	public function getItemType($con = null)
	{
		if ($this->aItemType === null && ($this->id_itemtype !== null)) {
						include_once 'lib/model/om/BaseItemTypePeer.php';

			$this->aItemType = ItemTypePeer::retrieveByPK($this->id_itemtype, $con);

			
		}
		return $this->aItemType;
	}

	
	public function initAvatar_Items()
	{
		if ($this->collAvatar_Items === null) {
			$this->collAvatar_Items = array();
		}
	}

	
	public function getAvatar_Items($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseAvatar_ItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAvatar_Items === null) {
			if ($this->isNew()) {
			   $this->collAvatar_Items = array();
			} else {

				$criteria->add(Avatar_ItemPeer::ID_ITEM, $this->getId());

				Avatar_ItemPeer::addSelectColumns($criteria);
				$this->collAvatar_Items = Avatar_ItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Avatar_ItemPeer::ID_ITEM, $this->getId());

				Avatar_ItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastAvatar_ItemCriteria) || !$this->lastAvatar_ItemCriteria->equals($criteria)) {
					$this->collAvatar_Items = Avatar_ItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAvatar_ItemCriteria = $criteria;
		return $this->collAvatar_Items;
	}

	
	public function countAvatar_Items($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseAvatar_ItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Avatar_ItemPeer::ID_ITEM, $this->getId());

		return Avatar_ItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAvatar_Item(Avatar_Item $l)
	{
		$this->collAvatar_Items[] = $l;
		$l->setItem($this);
	}


	
	public function getAvatar_ItemsJoinAvatar($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseAvatar_ItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAvatar_Items === null) {
			if ($this->isNew()) {
				$this->collAvatar_Items = array();
			} else {

				$criteria->add(Avatar_ItemPeer::ID_ITEM, $this->getId());

				$this->collAvatar_Items = Avatar_ItemPeer::doSelectJoinAvatar($criteria, $con);
			}
		} else {
									
			$criteria->add(Avatar_ItemPeer::ID_ITEM, $this->getId());

			if (!isset($this->lastAvatar_ItemCriteria) || !$this->lastAvatar_ItemCriteria->equals($criteria)) {
				$this->collAvatar_Items = Avatar_ItemPeer::doSelectJoinAvatar($criteria, $con);
			}
		}
		$this->lastAvatar_ItemCriteria = $criteria;

		return $this->collAvatar_Items;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseItem:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseItem::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 