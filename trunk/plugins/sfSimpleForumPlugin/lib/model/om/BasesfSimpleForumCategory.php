<?php


abstract class BasesfSimpleForumCategory extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $stripped_name;


	
	protected $description;


	
	protected $rank;


	
	protected $created_at;

	
	protected $collsfSimpleForumForums;

	
	protected $lastsfSimpleForumForumCriteria = null;

	
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

	
	public function getStrippedName()
	{

		return $this->stripped_name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getRank()
	{

		return $this->rank;
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
			$this->modifiedColumns[] = sfSimpleForumCategoryPeer::ID;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = sfSimpleForumCategoryPeer::NAME;
		}

	} 
	
	public function setStrippedName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stripped_name !== $v) {
			$this->stripped_name = $v;
			$this->modifiedColumns[] = sfSimpleForumCategoryPeer::STRIPPED_NAME;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = sfSimpleForumCategoryPeer::DESCRIPTION;
		}

	} 
	
	public function setRank($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->rank !== $v) {
			$this->rank = $v;
			$this->modifiedColumns[] = sfSimpleForumCategoryPeer::RANK;
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
			$this->modifiedColumns[] = sfSimpleForumCategoryPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->stripped_name = $rs->getString($startcol + 2);

			$this->description = $rs->getString($startcol + 3);

			$this->rank = $rs->getInt($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating sfSimpleForumCategory object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumCategory:delete:pre') as $callable)
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
			$con = Propel::getConnection(sfSimpleForumCategoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			sfSimpleForumCategoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasesfSimpleForumCategory:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumCategory:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(sfSimpleForumCategoryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumCategoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasesfSimpleForumCategory:save:post') as $callable)
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
					$pk = sfSimpleForumCategoryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += sfSimpleForumCategoryPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collsfSimpleForumForums !== null) {
				foreach($this->collsfSimpleForumForums as $referrerFK) {
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


			if (($retval = sfSimpleForumCategoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfSimpleForumForums !== null) {
					foreach($this->collsfSimpleForumForums as $referrerFK) {
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
		$pos = sfSimpleForumCategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getStrippedName();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getRank();
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
		$keys = sfSimpleForumCategoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getStrippedName(),
			$keys[3] => $this->getDescription(),
			$keys[4] => $this->getRank(),
			$keys[5] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfSimpleForumCategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setStrippedName($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setRank($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfSimpleForumCategoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStrippedName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRank($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(sfSimpleForumCategoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(sfSimpleForumCategoryPeer::ID)) $criteria->add(sfSimpleForumCategoryPeer::ID, $this->id);
		if ($this->isColumnModified(sfSimpleForumCategoryPeer::NAME)) $criteria->add(sfSimpleForumCategoryPeer::NAME, $this->name);
		if ($this->isColumnModified(sfSimpleForumCategoryPeer::STRIPPED_NAME)) $criteria->add(sfSimpleForumCategoryPeer::STRIPPED_NAME, $this->stripped_name);
		if ($this->isColumnModified(sfSimpleForumCategoryPeer::DESCRIPTION)) $criteria->add(sfSimpleForumCategoryPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(sfSimpleForumCategoryPeer::RANK)) $criteria->add(sfSimpleForumCategoryPeer::RANK, $this->rank);
		if ($this->isColumnModified(sfSimpleForumCategoryPeer::CREATED_AT)) $criteria->add(sfSimpleForumCategoryPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(sfSimpleForumCategoryPeer::DATABASE_NAME);

		$criteria->add(sfSimpleForumCategoryPeer::ID, $this->id);

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

		$copyObj->setStrippedName($this->stripped_name);

		$copyObj->setDescription($this->description);

		$copyObj->setRank($this->rank);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getsfSimpleForumForums() as $relObj) {
				$copyObj->addsfSimpleForumForum($relObj->copy($deepCopy));
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
			self::$peer = new sfSimpleForumCategoryPeer();
		}
		return self::$peer;
	}

	
	public function initsfSimpleForumForums()
	{
		if ($this->collsfSimpleForumForums === null) {
			$this->collsfSimpleForumForums = array();
		}
	}

	
	public function getsfSimpleForumForums($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumForumPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumForums === null) {
			if ($this->isNew()) {
			   $this->collsfSimpleForumForums = array();
			} else {

				$criteria->add(sfSimpleForumForumPeer::CATEGORY_ID, $this->getId());

				sfSimpleForumForumPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumForums = sfSimpleForumForumPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfSimpleForumForumPeer::CATEGORY_ID, $this->getId());

				sfSimpleForumForumPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfSimpleForumForumCriteria) || !$this->lastsfSimpleForumForumCriteria->equals($criteria)) {
					$this->collsfSimpleForumForums = sfSimpleForumForumPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfSimpleForumForumCriteria = $criteria;
		return $this->collsfSimpleForumForums;
	}

	
	public function countsfSimpleForumForums($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumForumPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfSimpleForumForumPeer::CATEGORY_ID, $this->getId());

		return sfSimpleForumForumPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfSimpleForumForum(sfSimpleForumForum $l)
	{
		$this->collsfSimpleForumForums[] = $l;
		$l->setsfSimpleForumCategory($this);
	}


	
	public function getsfSimpleForumForumsJoinsfSimpleForumPost($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumForumPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumForums === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumForums = array();
			} else {

				$criteria->add(sfSimpleForumForumPeer::CATEGORY_ID, $this->getId());

				$this->collsfSimpleForumForums = sfSimpleForumForumPeer::doSelectJoinsfSimpleForumPost($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumForumPeer::CATEGORY_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumForumCriteria) || !$this->lastsfSimpleForumForumCriteria->equals($criteria)) {
				$this->collsfSimpleForumForums = sfSimpleForumForumPeer::doSelectJoinsfSimpleForumPost($criteria, $con);
			}
		}
		$this->lastsfSimpleForumForumCriteria = $criteria;

		return $this->collsfSimpleForumForums;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasesfSimpleForumCategory:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasesfSimpleForumCategory::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 