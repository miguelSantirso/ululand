<?php


abstract class BaseAvatar extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $profile_id;


	
	protected $api_key;


	
	protected $gender;


	
	protected $total_credits = 0;


	
	protected $spent_credits = 0;

	
	protected $asfGuardUserProfile;

	
	protected $collAvatar_Groups;

	
	protected $lastAvatar_GroupCriteria = null;

	
	protected $collFriendshipsRelatedByIdAvatarA;

	
	protected $lastFriendshipRelatedByIdAvatarACriteria = null;

	
	protected $collFriendshipsRelatedByIdAvatarB;

	
	protected $lastFriendshipRelatedByIdAvatarBCriteria = null;

	
	protected $collAvatarPiecesRelatedByAuthorId;

	
	protected $lastAvatarPieceRelatedByAuthorIdCriteria = null;

	
	protected $collAvatarPiecesRelatedByOwnerId;

	
	protected $lastAvatarPieceRelatedByOwnerIdCriteria = null;

	
	protected $collAvatar_Items;

	
	protected $lastAvatar_ItemCriteria = null;

	
	protected $collComments;

	
	protected $lastCommentCriteria = null;

	
	protected $collMessagesRelatedByIdSender;

	
	protected $lastMessageRelatedByIdSenderCriteria = null;

	
	protected $collMessagesRelatedByIdRecipient;

	
	protected $lastMessageRelatedByIdRecipientCriteria = null;

	
	protected $collGameStat_Avatars;

	
	protected $lastGameStat_AvatarCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getProfileId()
	{

		return $this->profile_id;
	}

	
	public function getApiKey()
	{

		return $this->api_key;
	}

	
	public function getGender()
	{

		return $this->gender;
	}

	
	public function getTotalCredits()
	{

		return $this->total_credits;
	}

	
	public function getSpentCredits()
	{

		return $this->spent_credits;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = AvatarPeer::ID;
		}

	} 
	
	public function setProfileId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->profile_id !== $v) {
			$this->profile_id = $v;
			$this->modifiedColumns[] = AvatarPeer::PROFILE_ID;
		}

		if ($this->asfGuardUserProfile !== null && $this->asfGuardUserProfile->getId() !== $v) {
			$this->asfGuardUserProfile = null;
		}

	} 
	
	public function setApiKey($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->api_key !== $v) {
			$this->api_key = $v;
			$this->modifiedColumns[] = AvatarPeer::API_KEY;
		}

	} 
	
	public function setGender($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->gender !== $v) {
			$this->gender = $v;
			$this->modifiedColumns[] = AvatarPeer::GENDER;
		}

	} 
	
	public function setTotalCredits($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_credits !== $v || $v === 0) {
			$this->total_credits = $v;
			$this->modifiedColumns[] = AvatarPeer::TOTAL_CREDITS;
		}

	} 
	
	public function setSpentCredits($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->spent_credits !== $v || $v === 0) {
			$this->spent_credits = $v;
			$this->modifiedColumns[] = AvatarPeer::SPENT_CREDITS;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->profile_id = $rs->getInt($startcol + 1);

			$this->api_key = $rs->getString($startcol + 2);

			$this->gender = $rs->getInt($startcol + 3);

			$this->total_credits = $rs->getInt($startcol + 4);

			$this->spent_credits = $rs->getInt($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Avatar object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatar:delete:pre') as $callable)
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
			$con = Propel::getConnection(AvatarPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AvatarPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAvatar:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatar:save:pre') as $callable)
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
			$con = Propel::getConnection(AvatarPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAvatar:save:post') as $callable)
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


												
			if ($this->asfGuardUserProfile !== null) {
				if ($this->asfGuardUserProfile->isModified()) {
					$affectedRows += $this->asfGuardUserProfile->save($con);
				}
				$this->setsfGuardUserProfile($this->asfGuardUserProfile);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AvatarPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AvatarPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collAvatar_Groups !== null) {
				foreach($this->collAvatar_Groups as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFriendshipsRelatedByIdAvatarA !== null) {
				foreach($this->collFriendshipsRelatedByIdAvatarA as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFriendshipsRelatedByIdAvatarB !== null) {
				foreach($this->collFriendshipsRelatedByIdAvatarB as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAvatarPiecesRelatedByAuthorId !== null) {
				foreach($this->collAvatarPiecesRelatedByAuthorId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAvatarPiecesRelatedByOwnerId !== null) {
				foreach($this->collAvatarPiecesRelatedByOwnerId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAvatar_Items !== null) {
				foreach($this->collAvatar_Items as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collComments !== null) {
				foreach($this->collComments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMessagesRelatedByIdSender !== null) {
				foreach($this->collMessagesRelatedByIdSender as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMessagesRelatedByIdRecipient !== null) {
				foreach($this->collMessagesRelatedByIdRecipient as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGameStat_Avatars !== null) {
				foreach($this->collGameStat_Avatars as $referrerFK) {
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


												
			if ($this->asfGuardUserProfile !== null) {
				if (!$this->asfGuardUserProfile->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUserProfile->getValidationFailures());
				}
			}


			if (($retval = AvatarPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAvatar_Groups !== null) {
					foreach($this->collAvatar_Groups as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFriendshipsRelatedByIdAvatarA !== null) {
					foreach($this->collFriendshipsRelatedByIdAvatarA as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFriendshipsRelatedByIdAvatarB !== null) {
					foreach($this->collFriendshipsRelatedByIdAvatarB as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAvatarPiecesRelatedByAuthorId !== null) {
					foreach($this->collAvatarPiecesRelatedByAuthorId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAvatarPiecesRelatedByOwnerId !== null) {
					foreach($this->collAvatarPiecesRelatedByOwnerId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAvatar_Items !== null) {
					foreach($this->collAvatar_Items as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collComments !== null) {
					foreach($this->collComments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMessagesRelatedByIdSender !== null) {
					foreach($this->collMessagesRelatedByIdSender as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMessagesRelatedByIdRecipient !== null) {
					foreach($this->collMessagesRelatedByIdRecipient as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGameStat_Avatars !== null) {
					foreach($this->collGameStat_Avatars as $referrerFK) {
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
		$pos = AvatarPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getProfileId();
				break;
			case 2:
				return $this->getApiKey();
				break;
			case 3:
				return $this->getGender();
				break;
			case 4:
				return $this->getTotalCredits();
				break;
			case 5:
				return $this->getSpentCredits();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AvatarPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getProfileId(),
			$keys[2] => $this->getApiKey(),
			$keys[3] => $this->getGender(),
			$keys[4] => $this->getTotalCredits(),
			$keys[5] => $this->getSpentCredits(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AvatarPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setProfileId($value);
				break;
			case 2:
				$this->setApiKey($value);
				break;
			case 3:
				$this->setGender($value);
				break;
			case 4:
				$this->setTotalCredits($value);
				break;
			case 5:
				$this->setSpentCredits($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AvatarPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProfileId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setApiKey($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setGender($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTotalCredits($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSpentCredits($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AvatarPeer::DATABASE_NAME);

		if ($this->isColumnModified(AvatarPeer::ID)) $criteria->add(AvatarPeer::ID, $this->id);
		if ($this->isColumnModified(AvatarPeer::PROFILE_ID)) $criteria->add(AvatarPeer::PROFILE_ID, $this->profile_id);
		if ($this->isColumnModified(AvatarPeer::API_KEY)) $criteria->add(AvatarPeer::API_KEY, $this->api_key);
		if ($this->isColumnModified(AvatarPeer::GENDER)) $criteria->add(AvatarPeer::GENDER, $this->gender);
		if ($this->isColumnModified(AvatarPeer::TOTAL_CREDITS)) $criteria->add(AvatarPeer::TOTAL_CREDITS, $this->total_credits);
		if ($this->isColumnModified(AvatarPeer::SPENT_CREDITS)) $criteria->add(AvatarPeer::SPENT_CREDITS, $this->spent_credits);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AvatarPeer::DATABASE_NAME);

		$criteria->add(AvatarPeer::ID, $this->id);

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

		$copyObj->setProfileId($this->profile_id);

		$copyObj->setApiKey($this->api_key);

		$copyObj->setGender($this->gender);

		$copyObj->setTotalCredits($this->total_credits);

		$copyObj->setSpentCredits($this->spent_credits);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getAvatar_Groups() as $relObj) {
				$copyObj->addAvatar_Group($relObj->copy($deepCopy));
			}

			foreach($this->getFriendshipsRelatedByIdAvatarA() as $relObj) {
				$copyObj->addFriendshipRelatedByIdAvatarA($relObj->copy($deepCopy));
			}

			foreach($this->getFriendshipsRelatedByIdAvatarB() as $relObj) {
				$copyObj->addFriendshipRelatedByIdAvatarB($relObj->copy($deepCopy));
			}

			foreach($this->getAvatarPiecesRelatedByAuthorId() as $relObj) {
				$copyObj->addAvatarPieceRelatedByAuthorId($relObj->copy($deepCopy));
			}

			foreach($this->getAvatarPiecesRelatedByOwnerId() as $relObj) {
				$copyObj->addAvatarPieceRelatedByOwnerId($relObj->copy($deepCopy));
			}

			foreach($this->getAvatar_Items() as $relObj) {
				$copyObj->addAvatar_Item($relObj->copy($deepCopy));
			}

			foreach($this->getComments() as $relObj) {
				$copyObj->addComment($relObj->copy($deepCopy));
			}

			foreach($this->getMessagesRelatedByIdSender() as $relObj) {
				$copyObj->addMessageRelatedByIdSender($relObj->copy($deepCopy));
			}

			foreach($this->getMessagesRelatedByIdRecipient() as $relObj) {
				$copyObj->addMessageRelatedByIdRecipient($relObj->copy($deepCopy));
			}

			foreach($this->getGameStat_Avatars() as $relObj) {
				$copyObj->addGameStat_Avatar($relObj->copy($deepCopy));
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
			self::$peer = new AvatarPeer();
		}
		return self::$peer;
	}

	
	public function setsfGuardUserProfile($v)
	{


		if ($v === null) {
			$this->setProfileId(NULL);
		} else {
			$this->setProfileId($v->getId());
		}


		$this->asfGuardUserProfile = $v;
	}


	
	public function getsfGuardUserProfile($con = null)
	{
		if ($this->asfGuardUserProfile === null && ($this->profile_id !== null)) {
						include_once 'lib/model/om/BasesfGuardUserProfilePeer.php';

			$this->asfGuardUserProfile = sfGuardUserProfilePeer::retrieveByPK($this->profile_id, $con);

			
		}
		return $this->asfGuardUserProfile;
	}

	
	public function initAvatar_Groups()
	{
		if ($this->collAvatar_Groups === null) {
			$this->collAvatar_Groups = array();
		}
	}

	
	public function getAvatar_Groups($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseAvatar_GroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAvatar_Groups === null) {
			if ($this->isNew()) {
			   $this->collAvatar_Groups = array();
			} else {

				$criteria->add(Avatar_GroupPeer::AVATAR_ID, $this->getId());

				Avatar_GroupPeer::addSelectColumns($criteria);
				$this->collAvatar_Groups = Avatar_GroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Avatar_GroupPeer::AVATAR_ID, $this->getId());

				Avatar_GroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastAvatar_GroupCriteria) || !$this->lastAvatar_GroupCriteria->equals($criteria)) {
					$this->collAvatar_Groups = Avatar_GroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAvatar_GroupCriteria = $criteria;
		return $this->collAvatar_Groups;
	}

	
	public function countAvatar_Groups($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseAvatar_GroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(Avatar_GroupPeer::AVATAR_ID, $this->getId());

		return Avatar_GroupPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAvatar_Group(Avatar_Group $l)
	{
		$this->collAvatar_Groups[] = $l;
		$l->setAvatar($this);
	}


	
	public function getAvatar_GroupsJoinGroup($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseAvatar_GroupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAvatar_Groups === null) {
			if ($this->isNew()) {
				$this->collAvatar_Groups = array();
			} else {

				$criteria->add(Avatar_GroupPeer::AVATAR_ID, $this->getId());

				$this->collAvatar_Groups = Avatar_GroupPeer::doSelectJoinGroup($criteria, $con);
			}
		} else {
									
			$criteria->add(Avatar_GroupPeer::AVATAR_ID, $this->getId());

			if (!isset($this->lastAvatar_GroupCriteria) || !$this->lastAvatar_GroupCriteria->equals($criteria)) {
				$this->collAvatar_Groups = Avatar_GroupPeer::doSelectJoinGroup($criteria, $con);
			}
		}
		$this->lastAvatar_GroupCriteria = $criteria;

		return $this->collAvatar_Groups;
	}

	
	public function initFriendshipsRelatedByIdAvatarA()
	{
		if ($this->collFriendshipsRelatedByIdAvatarA === null) {
			$this->collFriendshipsRelatedByIdAvatarA = array();
		}
	}

	
	public function getFriendshipsRelatedByIdAvatarA($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFriendshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFriendshipsRelatedByIdAvatarA === null) {
			if ($this->isNew()) {
			   $this->collFriendshipsRelatedByIdAvatarA = array();
			} else {

				$criteria->add(FriendshipPeer::ID_AVATAR_A, $this->getId());

				FriendshipPeer::addSelectColumns($criteria);
				$this->collFriendshipsRelatedByIdAvatarA = FriendshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FriendshipPeer::ID_AVATAR_A, $this->getId());

				FriendshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastFriendshipRelatedByIdAvatarACriteria) || !$this->lastFriendshipRelatedByIdAvatarACriteria->equals($criteria)) {
					$this->collFriendshipsRelatedByIdAvatarA = FriendshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFriendshipRelatedByIdAvatarACriteria = $criteria;
		return $this->collFriendshipsRelatedByIdAvatarA;
	}

	
	public function countFriendshipsRelatedByIdAvatarA($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseFriendshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FriendshipPeer::ID_AVATAR_A, $this->getId());

		return FriendshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFriendshipRelatedByIdAvatarA(Friendship $l)
	{
		$this->collFriendshipsRelatedByIdAvatarA[] = $l;
		$l->setAvatarRelatedByIdAvatarA($this);
	}

	
	public function initFriendshipsRelatedByIdAvatarB()
	{
		if ($this->collFriendshipsRelatedByIdAvatarB === null) {
			$this->collFriendshipsRelatedByIdAvatarB = array();
		}
	}

	
	public function getFriendshipsRelatedByIdAvatarB($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFriendshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFriendshipsRelatedByIdAvatarB === null) {
			if ($this->isNew()) {
			   $this->collFriendshipsRelatedByIdAvatarB = array();
			} else {

				$criteria->add(FriendshipPeer::ID_AVATAR_B, $this->getId());

				FriendshipPeer::addSelectColumns($criteria);
				$this->collFriendshipsRelatedByIdAvatarB = FriendshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FriendshipPeer::ID_AVATAR_B, $this->getId());

				FriendshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastFriendshipRelatedByIdAvatarBCriteria) || !$this->lastFriendshipRelatedByIdAvatarBCriteria->equals($criteria)) {
					$this->collFriendshipsRelatedByIdAvatarB = FriendshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFriendshipRelatedByIdAvatarBCriteria = $criteria;
		return $this->collFriendshipsRelatedByIdAvatarB;
	}

	
	public function countFriendshipsRelatedByIdAvatarB($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseFriendshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FriendshipPeer::ID_AVATAR_B, $this->getId());

		return FriendshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFriendshipRelatedByIdAvatarB(Friendship $l)
	{
		$this->collFriendshipsRelatedByIdAvatarB[] = $l;
		$l->setAvatarRelatedByIdAvatarB($this);
	}

	
	public function initAvatarPiecesRelatedByAuthorId()
	{
		if ($this->collAvatarPiecesRelatedByAuthorId === null) {
			$this->collAvatarPiecesRelatedByAuthorId = array();
		}
	}

	
	public function getAvatarPiecesRelatedByAuthorId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseAvatarPiecePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAvatarPiecesRelatedByAuthorId === null) {
			if ($this->isNew()) {
			   $this->collAvatarPiecesRelatedByAuthorId = array();
			} else {

				$criteria->add(AvatarPiecePeer::AUTHOR_ID, $this->getId());

				AvatarPiecePeer::addSelectColumns($criteria);
				$this->collAvatarPiecesRelatedByAuthorId = AvatarPiecePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AvatarPiecePeer::AUTHOR_ID, $this->getId());

				AvatarPiecePeer::addSelectColumns($criteria);
				if (!isset($this->lastAvatarPieceRelatedByAuthorIdCriteria) || !$this->lastAvatarPieceRelatedByAuthorIdCriteria->equals($criteria)) {
					$this->collAvatarPiecesRelatedByAuthorId = AvatarPiecePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAvatarPieceRelatedByAuthorIdCriteria = $criteria;
		return $this->collAvatarPiecesRelatedByAuthorId;
	}

	
	public function countAvatarPiecesRelatedByAuthorId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseAvatarPiecePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AvatarPiecePeer::AUTHOR_ID, $this->getId());

		return AvatarPiecePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAvatarPieceRelatedByAuthorId(AvatarPiece $l)
	{
		$this->collAvatarPiecesRelatedByAuthorId[] = $l;
		$l->setAvatarRelatedByAuthorId($this);
	}

	
	public function initAvatarPiecesRelatedByOwnerId()
	{
		if ($this->collAvatarPiecesRelatedByOwnerId === null) {
			$this->collAvatarPiecesRelatedByOwnerId = array();
		}
	}

	
	public function getAvatarPiecesRelatedByOwnerId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseAvatarPiecePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAvatarPiecesRelatedByOwnerId === null) {
			if ($this->isNew()) {
			   $this->collAvatarPiecesRelatedByOwnerId = array();
			} else {

				$criteria->add(AvatarPiecePeer::OWNER_ID, $this->getId());

				AvatarPiecePeer::addSelectColumns($criteria);
				$this->collAvatarPiecesRelatedByOwnerId = AvatarPiecePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AvatarPiecePeer::OWNER_ID, $this->getId());

				AvatarPiecePeer::addSelectColumns($criteria);
				if (!isset($this->lastAvatarPieceRelatedByOwnerIdCriteria) || !$this->lastAvatarPieceRelatedByOwnerIdCriteria->equals($criteria)) {
					$this->collAvatarPiecesRelatedByOwnerId = AvatarPiecePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAvatarPieceRelatedByOwnerIdCriteria = $criteria;
		return $this->collAvatarPiecesRelatedByOwnerId;
	}

	
	public function countAvatarPiecesRelatedByOwnerId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseAvatarPiecePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AvatarPiecePeer::OWNER_ID, $this->getId());

		return AvatarPiecePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAvatarPieceRelatedByOwnerId(AvatarPiece $l)
	{
		$this->collAvatarPiecesRelatedByOwnerId[] = $l;
		$l->setAvatarRelatedByOwnerId($this);
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

				$criteria->add(Avatar_ItemPeer::ID_AVATAR, $this->getId());

				Avatar_ItemPeer::addSelectColumns($criteria);
				$this->collAvatar_Items = Avatar_ItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(Avatar_ItemPeer::ID_AVATAR, $this->getId());

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

		$criteria->add(Avatar_ItemPeer::ID_AVATAR, $this->getId());

		return Avatar_ItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAvatar_Item(Avatar_Item $l)
	{
		$this->collAvatar_Items[] = $l;
		$l->setAvatar($this);
	}


	
	public function getAvatar_ItemsJoinItem($criteria = null, $con = null)
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

				$criteria->add(Avatar_ItemPeer::ID_AVATAR, $this->getId());

				$this->collAvatar_Items = Avatar_ItemPeer::doSelectJoinItem($criteria, $con);
			}
		} else {
									
			$criteria->add(Avatar_ItemPeer::ID_AVATAR, $this->getId());

			if (!isset($this->lastAvatar_ItemCriteria) || !$this->lastAvatar_ItemCriteria->equals($criteria)) {
				$this->collAvatar_Items = Avatar_ItemPeer::doSelectJoinItem($criteria, $con);
			}
		}
		$this->lastAvatar_ItemCriteria = $criteria;

		return $this->collAvatar_Items;
	}

	
	public function initComments()
	{
		if ($this->collComments === null) {
			$this->collComments = array();
		}
	}

	
	public function getComments($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collComments === null) {
			if ($this->isNew()) {
			   $this->collComments = array();
			} else {

				$criteria->add(CommentPeer::ID_AVATAR, $this->getId());

				CommentPeer::addSelectColumns($criteria);
				$this->collComments = CommentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CommentPeer::ID_AVATAR, $this->getId());

				CommentPeer::addSelectColumns($criteria);
				if (!isset($this->lastCommentCriteria) || !$this->lastCommentCriteria->equals($criteria)) {
					$this->collComments = CommentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCommentCriteria = $criteria;
		return $this->collComments;
	}

	
	public function countComments($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CommentPeer::ID_AVATAR, $this->getId());

		return CommentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addComment(Comment $l)
	{
		$this->collComments[] = $l;
		$l->setAvatar($this);
	}


	
	public function getCommentsJoinGame($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collComments === null) {
			if ($this->isNew()) {
				$this->collComments = array();
			} else {

				$criteria->add(CommentPeer::ID_AVATAR, $this->getId());

				$this->collComments = CommentPeer::doSelectJoinGame($criteria, $con);
			}
		} else {
									
			$criteria->add(CommentPeer::ID_AVATAR, $this->getId());

			if (!isset($this->lastCommentCriteria) || !$this->lastCommentCriteria->equals($criteria)) {
				$this->collComments = CommentPeer::doSelectJoinGame($criteria, $con);
			}
		}
		$this->lastCommentCriteria = $criteria;

		return $this->collComments;
	}

	
	public function initMessagesRelatedByIdSender()
	{
		if ($this->collMessagesRelatedByIdSender === null) {
			$this->collMessagesRelatedByIdSender = array();
		}
	}

	
	public function getMessagesRelatedByIdSender($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMessagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMessagesRelatedByIdSender === null) {
			if ($this->isNew()) {
			   $this->collMessagesRelatedByIdSender = array();
			} else {

				$criteria->add(MessagePeer::ID_SENDER, $this->getId());

				MessagePeer::addSelectColumns($criteria);
				$this->collMessagesRelatedByIdSender = MessagePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MessagePeer::ID_SENDER, $this->getId());

				MessagePeer::addSelectColumns($criteria);
				if (!isset($this->lastMessageRelatedByIdSenderCriteria) || !$this->lastMessageRelatedByIdSenderCriteria->equals($criteria)) {
					$this->collMessagesRelatedByIdSender = MessagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMessageRelatedByIdSenderCriteria = $criteria;
		return $this->collMessagesRelatedByIdSender;
	}

	
	public function countMessagesRelatedByIdSender($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseMessagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MessagePeer::ID_SENDER, $this->getId());

		return MessagePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMessageRelatedByIdSender(Message $l)
	{
		$this->collMessagesRelatedByIdSender[] = $l;
		$l->setAvatarRelatedByIdSender($this);
	}

	
	public function initMessagesRelatedByIdRecipient()
	{
		if ($this->collMessagesRelatedByIdRecipient === null) {
			$this->collMessagesRelatedByIdRecipient = array();
		}
	}

	
	public function getMessagesRelatedByIdRecipient($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMessagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMessagesRelatedByIdRecipient === null) {
			if ($this->isNew()) {
			   $this->collMessagesRelatedByIdRecipient = array();
			} else {

				$criteria->add(MessagePeer::ID_RECIPIENT, $this->getId());

				MessagePeer::addSelectColumns($criteria);
				$this->collMessagesRelatedByIdRecipient = MessagePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MessagePeer::ID_RECIPIENT, $this->getId());

				MessagePeer::addSelectColumns($criteria);
				if (!isset($this->lastMessageRelatedByIdRecipientCriteria) || !$this->lastMessageRelatedByIdRecipientCriteria->equals($criteria)) {
					$this->collMessagesRelatedByIdRecipient = MessagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMessageRelatedByIdRecipientCriteria = $criteria;
		return $this->collMessagesRelatedByIdRecipient;
	}

	
	public function countMessagesRelatedByIdRecipient($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseMessagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MessagePeer::ID_RECIPIENT, $this->getId());

		return MessagePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMessageRelatedByIdRecipient(Message $l)
	{
		$this->collMessagesRelatedByIdRecipient[] = $l;
		$l->setAvatarRelatedByIdRecipient($this);
	}

	
	public function initGameStat_Avatars()
	{
		if ($this->collGameStat_Avatars === null) {
			$this->collGameStat_Avatars = array();
		}
	}

	
	public function getGameStat_Avatars($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseGameStat_AvatarPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGameStat_Avatars === null) {
			if ($this->isNew()) {
			   $this->collGameStat_Avatars = array();
			} else {

				$criteria->add(GameStat_AvatarPeer::AVATAR_ID, $this->getId());

				GameStat_AvatarPeer::addSelectColumns($criteria);
				$this->collGameStat_Avatars = GameStat_AvatarPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(GameStat_AvatarPeer::AVATAR_ID, $this->getId());

				GameStat_AvatarPeer::addSelectColumns($criteria);
				if (!isset($this->lastGameStat_AvatarCriteria) || !$this->lastGameStat_AvatarCriteria->equals($criteria)) {
					$this->collGameStat_Avatars = GameStat_AvatarPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGameStat_AvatarCriteria = $criteria;
		return $this->collGameStat_Avatars;
	}

	
	public function countGameStat_Avatars($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseGameStat_AvatarPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(GameStat_AvatarPeer::AVATAR_ID, $this->getId());

		return GameStat_AvatarPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addGameStat_Avatar(GameStat_Avatar $l)
	{
		$this->collGameStat_Avatars[] = $l;
		$l->setAvatar($this);
	}


	
	public function getGameStat_AvatarsJoinGameStat($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseGameStat_AvatarPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGameStat_Avatars === null) {
			if ($this->isNew()) {
				$this->collGameStat_Avatars = array();
			} else {

				$criteria->add(GameStat_AvatarPeer::AVATAR_ID, $this->getId());

				$this->collGameStat_Avatars = GameStat_AvatarPeer::doSelectJoinGameStat($criteria, $con);
			}
		} else {
									
			$criteria->add(GameStat_AvatarPeer::AVATAR_ID, $this->getId());

			if (!isset($this->lastGameStat_AvatarCriteria) || !$this->lastGameStat_AvatarCriteria->equals($criteria)) {
				$this->collGameStat_Avatars = GameStat_AvatarPeer::doSelectJoinGameStat($criteria, $con);
			}
		}
		$this->lastGameStat_AvatarCriteria = $criteria;

		return $this->collGameStat_Avatars;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAvatar:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAvatar::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 