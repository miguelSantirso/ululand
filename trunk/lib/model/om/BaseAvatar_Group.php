<?php


abstract class BaseAvatar_Group extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $avatar_id;


	
	protected $grupo_id;


	
	protected $is_owner = false;


	
	protected $is_approved = false;

	
	protected $aAvatar;

	
	protected $aGroup;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getAvatarId()
	{

		return $this->avatar_id;
	}

	
	public function getGrupoId()
	{

		return $this->grupo_id;
	}

	
	public function getIsOwner()
	{

		return $this->is_owner;
	}

	
	public function getIsApproved()
	{

		return $this->is_approved;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = Avatar_GroupPeer::ID;
		}

	} 
	
	public function setAvatarId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->avatar_id !== $v) {
			$this->avatar_id = $v;
			$this->modifiedColumns[] = Avatar_GroupPeer::AVATAR_ID;
		}

		if ($this->aAvatar !== null && $this->aAvatar->getId() !== $v) {
			$this->aAvatar = null;
		}

	} 
	
	public function setGrupoId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->grupo_id !== $v) {
			$this->grupo_id = $v;
			$this->modifiedColumns[] = Avatar_GroupPeer::GRUPO_ID;
		}

		if ($this->aGroup !== null && $this->aGroup->getId() !== $v) {
			$this->aGroup = null;
		}

	} 
	
	public function setIsOwner($v)
	{

		if ($this->is_owner !== $v || $v === false) {
			$this->is_owner = $v;
			$this->modifiedColumns[] = Avatar_GroupPeer::IS_OWNER;
		}

	} 
	
	public function setIsApproved($v)
	{

		if ($this->is_approved !== $v || $v === false) {
			$this->is_approved = $v;
			$this->modifiedColumns[] = Avatar_GroupPeer::IS_APPROVED;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->avatar_id = $rs->getInt($startcol + 1);

			$this->grupo_id = $rs->getInt($startcol + 2);

			$this->is_owner = $rs->getBoolean($startcol + 3);

			$this->is_approved = $rs->getBoolean($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Avatar_Group object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatar_Group:delete:pre') as $callable)
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
			$con = Propel::getConnection(Avatar_GroupPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			Avatar_GroupPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAvatar_Group:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatar_Group:save:pre') as $callable)
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
			$con = Propel::getConnection(Avatar_GroupPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAvatar_Group:save:post') as $callable)
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


												
			if ($this->aAvatar !== null) {
				if ($this->aAvatar->isModified()) {
					$affectedRows += $this->aAvatar->save($con);
				}
				$this->setAvatar($this->aAvatar);
			}

			if ($this->aGroup !== null) {
				if ($this->aGroup->isModified()) {
					$affectedRows += $this->aGroup->save($con);
				}
				$this->setGroup($this->aGroup);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = Avatar_GroupPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += Avatar_GroupPeer::doUpdate($this, $con);
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


												
			if ($this->aAvatar !== null) {
				if (!$this->aAvatar->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAvatar->getValidationFailures());
				}
			}

			if ($this->aGroup !== null) {
				if (!$this->aGroup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aGroup->getValidationFailures());
				}
			}


			if (($retval = Avatar_GroupPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Avatar_GroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getAvatarId();
				break;
			case 2:
				return $this->getGrupoId();
				break;
			case 3:
				return $this->getIsOwner();
				break;
			case 4:
				return $this->getIsApproved();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Avatar_GroupPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAvatarId(),
			$keys[2] => $this->getGrupoId(),
			$keys[3] => $this->getIsOwner(),
			$keys[4] => $this->getIsApproved(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = Avatar_GroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setAvatarId($value);
				break;
			case 2:
				$this->setGrupoId($value);
				break;
			case 3:
				$this->setIsOwner($value);
				break;
			case 4:
				$this->setIsApproved($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = Avatar_GroupPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAvatarId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setGrupoId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsOwner($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsApproved($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(Avatar_GroupPeer::DATABASE_NAME);

		if ($this->isColumnModified(Avatar_GroupPeer::ID)) $criteria->add(Avatar_GroupPeer::ID, $this->id);
		if ($this->isColumnModified(Avatar_GroupPeer::AVATAR_ID)) $criteria->add(Avatar_GroupPeer::AVATAR_ID, $this->avatar_id);
		if ($this->isColumnModified(Avatar_GroupPeer::GRUPO_ID)) $criteria->add(Avatar_GroupPeer::GRUPO_ID, $this->grupo_id);
		if ($this->isColumnModified(Avatar_GroupPeer::IS_OWNER)) $criteria->add(Avatar_GroupPeer::IS_OWNER, $this->is_owner);
		if ($this->isColumnModified(Avatar_GroupPeer::IS_APPROVED)) $criteria->add(Avatar_GroupPeer::IS_APPROVED, $this->is_approved);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(Avatar_GroupPeer::DATABASE_NAME);

		$criteria->add(Avatar_GroupPeer::ID, $this->id);

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

		$copyObj->setAvatarId($this->avatar_id);

		$copyObj->setGrupoId($this->grupo_id);

		$copyObj->setIsOwner($this->is_owner);

		$copyObj->setIsApproved($this->is_approved);


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
			self::$peer = new Avatar_GroupPeer();
		}
		return self::$peer;
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

	
	public function setGroup($v)
	{


		if ($v === null) {
			$this->setGrupoId(NULL);
		} else {
			$this->setGrupoId($v->getId());
		}


		$this->aGroup = $v;
	}


	
	public function getGroup($con = null)
	{
		if ($this->aGroup === null && ($this->grupo_id !== null)) {
						include_once 'lib/model/om/BaseGroupPeer.php';

			$this->aGroup = GroupPeer::retrieveByPK($this->grupo_id, $con);

			
		}
		return $this->aGroup;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAvatar_Group:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAvatar_Group::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 