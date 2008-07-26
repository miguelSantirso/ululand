<?php


abstract class BaseAccount extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $email;


	
	protected $hashedpassword;


	
	protected $salt;


	
	protected $created_at;


	
	protected $confirmation_date;


	
	protected $account_level = 1;


	
	protected $sessionid;


	
	protected $is_approved;

	
	protected $collsfSimpleForumTopics;

	
	protected $lastsfSimpleForumTopicCriteria = null;

	
	protected $collsfSimpleForumPosts;

	
	protected $lastsfSimpleForumPostCriteria = null;

	
	protected $collsfSimpleForumTopicViews;

	
	protected $lastsfSimpleForumTopicViewCriteria = null;

	
	protected $collAvatars;

	
	protected $lastAvatarCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getHashedpassword()
	{

		return $this->hashedpassword;
	}

	
	public function getSalt()
	{

		return $this->salt;
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

	
	public function getConfirmationDate()
	{

		return $this->confirmation_date;
	}

	
	public function getAccountLevel()
	{

		return $this->account_level;
	}

	
	public function getSessionid()
	{

		return $this->sessionid;
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
			$this->modifiedColumns[] = AccountPeer::ID;
		}

	} 
	
	public function setEmail($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = AccountPeer::EMAIL;
		}

	} 
	
	public function setHashedpassword($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->hashedpassword !== $v) {
			$this->hashedpassword = $v;
			$this->modifiedColumns[] = AccountPeer::HASHEDPASSWORD;
		}

	} 
	
	public function setSalt($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = AccountPeer::SALT;
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
			$this->modifiedColumns[] = AccountPeer::CREATED_AT;
		}

	} 
	
	public function setConfirmationDate($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->confirmation_date !== $v) {
			$this->confirmation_date = $v;
			$this->modifiedColumns[] = AccountPeer::CONFIRMATION_DATE;
		}

	} 
	
	public function setAccountLevel($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->account_level !== $v || $v === 1) {
			$this->account_level = $v;
			$this->modifiedColumns[] = AccountPeer::ACCOUNT_LEVEL;
		}

	} 
	
	public function setSessionid($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sessionid !== $v) {
			$this->sessionid = $v;
			$this->modifiedColumns[] = AccountPeer::SESSIONID;
		}

	} 
	
	public function setIsApproved($v)
	{

		if ($this->is_approved !== $v) {
			$this->is_approved = $v;
			$this->modifiedColumns[] = AccountPeer::IS_APPROVED;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->email = $rs->getString($startcol + 1);

			$this->hashedpassword = $rs->getString($startcol + 2);

			$this->salt = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->confirmation_date = $rs->getString($startcol + 5);

			$this->account_level = $rs->getInt($startcol + 6);

			$this->sessionid = $rs->getInt($startcol + 7);

			$this->is_approved = $rs->getBoolean($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Account object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseAccount:delete:pre') as $callable)
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
			$con = Propel::getConnection(AccountPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AccountPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAccount:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseAccount:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(AccountPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AccountPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAccount:save:post') as $callable)
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
					$pk = AccountPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AccountPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collsfSimpleForumTopics !== null) {
				foreach($this->collsfSimpleForumTopics as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfSimpleForumPosts !== null) {
				foreach($this->collsfSimpleForumPosts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfSimpleForumTopicViews !== null) {
				foreach($this->collsfSimpleForumTopicViews as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAvatars !== null) {
				foreach($this->collAvatars as $referrerFK) {
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


			if (($retval = AccountPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfSimpleForumTopics !== null) {
					foreach($this->collsfSimpleForumTopics as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfSimpleForumPosts !== null) {
					foreach($this->collsfSimpleForumPosts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfSimpleForumTopicViews !== null) {
					foreach($this->collsfSimpleForumTopicViews as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAvatars !== null) {
					foreach($this->collAvatars as $referrerFK) {
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
		$pos = AccountPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getEmail();
				break;
			case 2:
				return $this->getHashedpassword();
				break;
			case 3:
				return $this->getSalt();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getConfirmationDate();
				break;
			case 6:
				return $this->getAccountLevel();
				break;
			case 7:
				return $this->getSessionid();
				break;
			case 8:
				return $this->getIsApproved();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AccountPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getEmail(),
			$keys[2] => $this->getHashedpassword(),
			$keys[3] => $this->getSalt(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getConfirmationDate(),
			$keys[6] => $this->getAccountLevel(),
			$keys[7] => $this->getSessionid(),
			$keys[8] => $this->getIsApproved(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AccountPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setEmail($value);
				break;
			case 2:
				$this->setHashedpassword($value);
				break;
			case 3:
				$this->setSalt($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setConfirmationDate($value);
				break;
			case 6:
				$this->setAccountLevel($value);
				break;
			case 7:
				$this->setSessionid($value);
				break;
			case 8:
				$this->setIsApproved($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AccountPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEmail($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setHashedpassword($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSalt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setConfirmationDate($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAccountLevel($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSessionid($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsApproved($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AccountPeer::DATABASE_NAME);

		if ($this->isColumnModified(AccountPeer::ID)) $criteria->add(AccountPeer::ID, $this->id);
		if ($this->isColumnModified(AccountPeer::EMAIL)) $criteria->add(AccountPeer::EMAIL, $this->email);
		if ($this->isColumnModified(AccountPeer::HASHEDPASSWORD)) $criteria->add(AccountPeer::HASHEDPASSWORD, $this->hashedpassword);
		if ($this->isColumnModified(AccountPeer::SALT)) $criteria->add(AccountPeer::SALT, $this->salt);
		if ($this->isColumnModified(AccountPeer::CREATED_AT)) $criteria->add(AccountPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(AccountPeer::CONFIRMATION_DATE)) $criteria->add(AccountPeer::CONFIRMATION_DATE, $this->confirmation_date);
		if ($this->isColumnModified(AccountPeer::ACCOUNT_LEVEL)) $criteria->add(AccountPeer::ACCOUNT_LEVEL, $this->account_level);
		if ($this->isColumnModified(AccountPeer::SESSIONID)) $criteria->add(AccountPeer::SESSIONID, $this->sessionid);
		if ($this->isColumnModified(AccountPeer::IS_APPROVED)) $criteria->add(AccountPeer::IS_APPROVED, $this->is_approved);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AccountPeer::DATABASE_NAME);

		$criteria->add(AccountPeer::ID, $this->id);

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

		$copyObj->setEmail($this->email);

		$copyObj->setHashedpassword($this->hashedpassword);

		$copyObj->setSalt($this->salt);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setConfirmationDate($this->confirmation_date);

		$copyObj->setAccountLevel($this->account_level);

		$copyObj->setSessionid($this->sessionid);

		$copyObj->setIsApproved($this->is_approved);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getsfSimpleForumTopics() as $relObj) {
				$copyObj->addsfSimpleForumTopic($relObj->copy($deepCopy));
			}

			foreach($this->getsfSimpleForumPosts() as $relObj) {
				$copyObj->addsfSimpleForumPost($relObj->copy($deepCopy));
			}

			foreach($this->getsfSimpleForumTopicViews() as $relObj) {
				$copyObj->addsfSimpleForumTopicView($relObj->copy($deepCopy));
			}

			foreach($this->getAvatars() as $relObj) {
				$copyObj->addAvatar($relObj->copy($deepCopy));
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
			self::$peer = new AccountPeer();
		}
		return self::$peer;
	}

	
	public function initsfSimpleForumTopics()
	{
		if ($this->collsfSimpleForumTopics === null) {
			$this->collsfSimpleForumTopics = array();
		}
	}

	
	public function getsfSimpleForumTopics($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumTopicPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumTopics === null) {
			if ($this->isNew()) {
			   $this->collsfSimpleForumTopics = array();
			} else {

				$criteria->add(sfSimpleForumTopicPeer::USER_ID, $this->getId());

				sfSimpleForumTopicPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfSimpleForumTopicPeer::USER_ID, $this->getId());

				sfSimpleForumTopicPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfSimpleForumTopicCriteria) || !$this->lastsfSimpleForumTopicCriteria->equals($criteria)) {
					$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfSimpleForumTopicCriteria = $criteria;
		return $this->collsfSimpleForumTopics;
	}

	
	public function countsfSimpleForumTopics($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumTopicPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfSimpleForumTopicPeer::USER_ID, $this->getId());

		return sfSimpleForumTopicPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfSimpleForumTopic(sfSimpleForumTopic $l)
	{
		$this->collsfSimpleForumTopics[] = $l;
		$l->setAccount($this);
	}


	
	public function getsfSimpleForumTopicsJoinsfSimpleForumForum($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumTopicPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumTopics === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumTopics = array();
			} else {

				$criteria->add(sfSimpleForumTopicPeer::USER_ID, $this->getId());

				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfSimpleForumForum($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumTopicPeer::USER_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumTopicCriteria) || !$this->lastsfSimpleForumTopicCriteria->equals($criteria)) {
				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfSimpleForumForum($criteria, $con);
			}
		}
		$this->lastsfSimpleForumTopicCriteria = $criteria;

		return $this->collsfSimpleForumTopics;
	}


	
	public function getsfSimpleForumTopicsJoinsfSimpleForumPost($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumTopicPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumTopics === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumTopics = array();
			} else {

				$criteria->add(sfSimpleForumTopicPeer::USER_ID, $this->getId());

				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfSimpleForumPost($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumTopicPeer::USER_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumTopicCriteria) || !$this->lastsfSimpleForumTopicCriteria->equals($criteria)) {
				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfSimpleForumPost($criteria, $con);
			}
		}
		$this->lastsfSimpleForumTopicCriteria = $criteria;

		return $this->collsfSimpleForumTopics;
	}

	
	public function initsfSimpleForumPosts()
	{
		if ($this->collsfSimpleForumPosts === null) {
			$this->collsfSimpleForumPosts = array();
		}
	}

	
	public function getsfSimpleForumPosts($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
			   $this->collsfSimpleForumPosts = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::USER_ID, $this->getId());

				sfSimpleForumPostPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfSimpleForumPostPeer::USER_ID, $this->getId());

				sfSimpleForumPostPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
					$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;
		return $this->collsfSimpleForumPosts;
	}

	
	public function countsfSimpleForumPosts($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfSimpleForumPostPeer::USER_ID, $this->getId());

		return sfSimpleForumPostPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfSimpleForumPost(sfSimpleForumPost $l)
	{
		$this->collsfSimpleForumPosts[] = $l;
		$l->setAccount($this);
	}


	
	public function getsfSimpleForumPostsJoinsfSimpleForumTopic($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumPosts = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::USER_ID, $this->getId());

				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumTopic($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumPostPeer::USER_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumTopic($criteria, $con);
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;

		return $this->collsfSimpleForumPosts;
	}


	
	public function getsfSimpleForumPostsJoinsfSimpleForumForum($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumPosts = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::USER_ID, $this->getId());

				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumForum($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumPostPeer::USER_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumForum($criteria, $con);
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;

		return $this->collsfSimpleForumPosts;
	}

	
	public function initsfSimpleForumTopicViews()
	{
		if ($this->collsfSimpleForumTopicViews === null) {
			$this->collsfSimpleForumTopicViews = array();
		}
	}

	
	public function getsfSimpleForumTopicViews($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumTopicViewPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumTopicViews === null) {
			if ($this->isNew()) {
			   $this->collsfSimpleForumTopicViews = array();
			} else {

				$criteria->add(sfSimpleForumTopicViewPeer::USER_ID, $this->getId());

				sfSimpleForumTopicViewPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumTopicViews = sfSimpleForumTopicViewPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfSimpleForumTopicViewPeer::USER_ID, $this->getId());

				sfSimpleForumTopicViewPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfSimpleForumTopicViewCriteria) || !$this->lastsfSimpleForumTopicViewCriteria->equals($criteria)) {
					$this->collsfSimpleForumTopicViews = sfSimpleForumTopicViewPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfSimpleForumTopicViewCriteria = $criteria;
		return $this->collsfSimpleForumTopicViews;
	}

	
	public function countsfSimpleForumTopicViews($criteria = null, $distinct = false, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumTopicViewPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(sfSimpleForumTopicViewPeer::USER_ID, $this->getId());

		return sfSimpleForumTopicViewPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfSimpleForumTopicView(sfSimpleForumTopicView $l)
	{
		$this->collsfSimpleForumTopicViews[] = $l;
		$l->setAccount($this);
	}


	
	public function getsfSimpleForumTopicViewsJoinsfSimpleForumTopic($criteria = null, $con = null)
	{
				include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumTopicViewPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumTopicViews === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumTopicViews = array();
			} else {

				$criteria->add(sfSimpleForumTopicViewPeer::USER_ID, $this->getId());

				$this->collsfSimpleForumTopicViews = sfSimpleForumTopicViewPeer::doSelectJoinsfSimpleForumTopic($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumTopicViewPeer::USER_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumTopicViewCriteria) || !$this->lastsfSimpleForumTopicViewCriteria->equals($criteria)) {
				$this->collsfSimpleForumTopicViews = sfSimpleForumTopicViewPeer::doSelectJoinsfSimpleForumTopic($criteria, $con);
			}
		}
		$this->lastsfSimpleForumTopicViewCriteria = $criteria;

		return $this->collsfSimpleForumTopicViews;
	}

	
	public function initAvatars()
	{
		if ($this->collAvatars === null) {
			$this->collAvatars = array();
		}
	}

	
	public function getAvatars($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseAvatarPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAvatars === null) {
			if ($this->isNew()) {
			   $this->collAvatars = array();
			} else {

				$criteria->add(AvatarPeer::ACCOUNT_ID, $this->getId());

				AvatarPeer::addSelectColumns($criteria);
				$this->collAvatars = AvatarPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AvatarPeer::ACCOUNT_ID, $this->getId());

				AvatarPeer::addSelectColumns($criteria);
				if (!isset($this->lastAvatarCriteria) || !$this->lastAvatarCriteria->equals($criteria)) {
					$this->collAvatars = AvatarPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAvatarCriteria = $criteria;
		return $this->collAvatars;
	}

	
	public function countAvatars($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseAvatarPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AvatarPeer::ACCOUNT_ID, $this->getId());

		return AvatarPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAvatar(Avatar $l)
	{
		$this->collAvatars[] = $l;
		$l->setAccount($this);
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAccount:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAccount::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 