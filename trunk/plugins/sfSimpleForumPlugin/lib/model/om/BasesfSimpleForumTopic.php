<?php


abstract class BasesfSimpleForumTopic extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $title;


	
	protected $is_sticked = false;


	
	protected $is_locked = false;


	
	protected $forum_id;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $latest_post_id;


	
	protected $user_id;


	
	protected $stripped_title;


	
	protected $nb_posts = '0';


	
	protected $nb_views = '0';

	
	protected $asfSimpleForumForum;

	
	protected $asfSimpleForumPost;

	
	protected $aAccount;

	
	protected $collsfSimpleForumPosts;

	
	protected $lastsfSimpleForumPostCriteria = null;

	
	protected $collsfSimpleForumTopicViews;

	
	protected $lastsfSimpleForumTopicViewCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getIsSticked()
	{

		return $this->is_sticked;
	}

	
	public function getIsLocked()
	{

		return $this->is_locked;
	}

	
	public function getForumId()
	{

		return $this->forum_id;
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

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getLatestPostId()
	{

		return $this->latest_post_id;
	}

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getStrippedTitle()
	{

		return $this->stripped_title;
	}

	
	public function getNbPosts()
	{

		return $this->nb_posts;
	}

	
	public function getNbViews()
	{

		return $this->nb_views;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::ID;
		}

	} 
	
	public function setTitle($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::TITLE;
		}

	} 
	
	public function setIsSticked($v)
	{

		if ($this->is_sticked !== $v || $v === false) {
			$this->is_sticked = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::IS_STICKED;
		}

	} 
	
	public function setIsLocked($v)
	{

		if ($this->is_locked !== $v || $v === false) {
			$this->is_locked = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::IS_LOCKED;
		}

	} 
	
	public function setForumId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->forum_id !== $v) {
			$this->forum_id = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::FORUM_ID;
		}

		if ($this->asfSimpleForumForum !== null && $this->asfSimpleForumForum->getId() !== $v) {
			$this->asfSimpleForumForum = null;
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
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::UPDATED_AT;
		}

	} 
	
	public function setLatestPostId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->latest_post_id !== $v) {
			$this->latest_post_id = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::LATEST_POST_ID;
		}

		if ($this->asfSimpleForumPost !== null && $this->asfSimpleForumPost->getId() !== $v) {
			$this->asfSimpleForumPost = null;
		}

	} 
	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::USER_ID;
		}

		if ($this->aAccount !== null && $this->aAccount->getId() !== $v) {
			$this->aAccount = null;
		}

	} 
	
	public function setStrippedTitle($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stripped_title !== $v) {
			$this->stripped_title = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::STRIPPED_TITLE;
		}

	} 
	
	public function setNbPosts($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nb_posts !== $v || $v === '0') {
			$this->nb_posts = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::NB_POSTS;
		}

	} 
	
	public function setNbViews($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nb_views !== $v || $v === '0') {
			$this->nb_views = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::NB_VIEWS;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->title = $rs->getString($startcol + 1);

			$this->is_sticked = $rs->getBoolean($startcol + 2);

			$this->is_locked = $rs->getBoolean($startcol + 3);

			$this->forum_id = $rs->getInt($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->latest_post_id = $rs->getInt($startcol + 7);

			$this->user_id = $rs->getInt($startcol + 8);

			$this->stripped_title = $rs->getString($startcol + 9);

			$this->nb_posts = $rs->getString($startcol + 10);

			$this->nb_views = $rs->getString($startcol + 11);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating sfSimpleForumTopic object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumTopic:delete:pre') as $callable)
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
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			sfSimpleForumTopicPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasesfSimpleForumTopic:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumTopic:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(sfSimpleForumTopicPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(sfSimpleForumTopicPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasesfSimpleForumTopic:save:post') as $callable)
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


												
			if ($this->asfSimpleForumForum !== null) {
				if ($this->asfSimpleForumForum->isModified()) {
					$affectedRows += $this->asfSimpleForumForum->save($con);
				}
				$this->setsfSimpleForumForum($this->asfSimpleForumForum);
			}

			if ($this->asfSimpleForumPost !== null) {
				if ($this->asfSimpleForumPost->isModified()) {
					$affectedRows += $this->asfSimpleForumPost->save($con);
				}
				$this->setsfSimpleForumPost($this->asfSimpleForumPost);
			}

			if ($this->aAccount !== null) {
				if ($this->aAccount->isModified()) {
					$affectedRows += $this->aAccount->save($con);
				}
				$this->setAccount($this->aAccount);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfSimpleForumTopicPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += sfSimpleForumTopicPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->asfSimpleForumForum !== null) {
				if (!$this->asfSimpleForumForum->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfSimpleForumForum->getValidationFailures());
				}
			}

			if ($this->asfSimpleForumPost !== null) {
				if (!$this->asfSimpleForumPost->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfSimpleForumPost->getValidationFailures());
				}
			}

			if ($this->aAccount !== null) {
				if (!$this->aAccount->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAccount->getValidationFailures());
				}
			}


			if (($retval = sfSimpleForumTopicPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfSimpleForumTopicPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getIsSticked();
				break;
			case 3:
				return $this->getIsLocked();
				break;
			case 4:
				return $this->getForumId();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			case 7:
				return $this->getLatestPostId();
				break;
			case 8:
				return $this->getUserId();
				break;
			case 9:
				return $this->getStrippedTitle();
				break;
			case 10:
				return $this->getNbPosts();
				break;
			case 11:
				return $this->getNbViews();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfSimpleForumTopicPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getIsSticked(),
			$keys[3] => $this->getIsLocked(),
			$keys[4] => $this->getForumId(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
			$keys[7] => $this->getLatestPostId(),
			$keys[8] => $this->getUserId(),
			$keys[9] => $this->getStrippedTitle(),
			$keys[10] => $this->getNbPosts(),
			$keys[11] => $this->getNbViews(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfSimpleForumTopicPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setIsSticked($value);
				break;
			case 3:
				$this->setIsLocked($value);
				break;
			case 4:
				$this->setForumId($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
			case 7:
				$this->setLatestPostId($value);
				break;
			case 8:
				$this->setUserId($value);
				break;
			case 9:
				$this->setStrippedTitle($value);
				break;
			case 10:
				$this->setNbPosts($value);
				break;
			case 11:
				$this->setNbViews($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfSimpleForumTopicPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsSticked($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsLocked($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setForumId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLatestPostId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUserId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setStrippedTitle($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setNbPosts($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setNbViews($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME);

		if ($this->isColumnModified(sfSimpleForumTopicPeer::ID)) $criteria->add(sfSimpleForumTopicPeer::ID, $this->id);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::TITLE)) $criteria->add(sfSimpleForumTopicPeer::TITLE, $this->title);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::IS_STICKED)) $criteria->add(sfSimpleForumTopicPeer::IS_STICKED, $this->is_sticked);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::IS_LOCKED)) $criteria->add(sfSimpleForumTopicPeer::IS_LOCKED, $this->is_locked);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::FORUM_ID)) $criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->forum_id);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::CREATED_AT)) $criteria->add(sfSimpleForumTopicPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::UPDATED_AT)) $criteria->add(sfSimpleForumTopicPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::LATEST_POST_ID)) $criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->latest_post_id);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::USER_ID)) $criteria->add(sfSimpleForumTopicPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::STRIPPED_TITLE)) $criteria->add(sfSimpleForumTopicPeer::STRIPPED_TITLE, $this->stripped_title);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::NB_POSTS)) $criteria->add(sfSimpleForumTopicPeer::NB_POSTS, $this->nb_posts);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::NB_VIEWS)) $criteria->add(sfSimpleForumTopicPeer::NB_VIEWS, $this->nb_views);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME);

		$criteria->add(sfSimpleForumTopicPeer::ID, $this->id);

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

		$copyObj->setTitle($this->title);

		$copyObj->setIsSticked($this->is_sticked);

		$copyObj->setIsLocked($this->is_locked);

		$copyObj->setForumId($this->forum_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setLatestPostId($this->latest_post_id);

		$copyObj->setUserId($this->user_id);

		$copyObj->setStrippedTitle($this->stripped_title);

		$copyObj->setNbPosts($this->nb_posts);

		$copyObj->setNbViews($this->nb_views);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getsfSimpleForumPosts() as $relObj) {
				$copyObj->addsfSimpleForumPost($relObj->copy($deepCopy));
			}

			foreach($this->getsfSimpleForumTopicViews() as $relObj) {
				$copyObj->addsfSimpleForumTopicView($relObj->copy($deepCopy));
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
			self::$peer = new sfSimpleForumTopicPeer();
		}
		return self::$peer;
	}

	
	public function setsfSimpleForumForum($v)
	{


		if ($v === null) {
			$this->setForumId(NULL);
		} else {
			$this->setForumId($v->getId());
		}


		$this->asfSimpleForumForum = $v;
	}


	
	public function getsfSimpleForumForum($con = null)
	{
		if ($this->asfSimpleForumForum === null && ($this->forum_id !== null)) {
						include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumForumPeer.php';

			$this->asfSimpleForumForum = sfSimpleForumForumPeer::retrieveByPK($this->forum_id, $con);

			
		}
		return $this->asfSimpleForumForum;
	}

	
	public function setsfSimpleForumPost($v)
	{


		if ($v === null) {
			$this->setLatestPostId(NULL);
		} else {
			$this->setLatestPostId($v->getId());
		}


		$this->asfSimpleForumPost = $v;
	}


	
	public function getsfSimpleForumPost($con = null)
	{
		if ($this->asfSimpleForumPost === null && ($this->latest_post_id !== null)) {
						include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumPostPeer.php';

			$this->asfSimpleForumPost = sfSimpleForumPostPeer::retrieveByPK($this->latest_post_id, $con);

			
		}
		return $this->asfSimpleForumPost;
	}

	
	public function setAccount($v)
	{


		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}


		$this->aAccount = $v;
	}


	
	public function getAccount($con = null)
	{
		if ($this->aAccount === null && ($this->user_id !== null)) {
						include_once 'lib/model/om/BaseAccountPeer.php';

			$this->aAccount = AccountPeer::retrieveByPK($this->user_id, $con);

			
		}
		return $this->aAccount;
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

				$criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->getId());

				sfSimpleForumPostPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->getId());

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

		$criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->getId());

		return sfSimpleForumPostPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfSimpleForumPost(sfSimpleForumPost $l)
	{
		$this->collsfSimpleForumPosts[] = $l;
		$l->setsfSimpleForumTopic($this);
	}


	
	public function getsfSimpleForumPostsJoinAccount($criteria = null, $con = null)
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

				$criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->getId());

				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinAccount($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinAccount($criteria, $con);
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

				$criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->getId());

				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumForum($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->getId());

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

				$criteria->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $this->getId());

				sfSimpleForumTopicViewPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumTopicViews = sfSimpleForumTopicViewPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $this->getId());

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

		$criteria->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $this->getId());

		return sfSimpleForumTopicViewPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfSimpleForumTopicView(sfSimpleForumTopicView $l)
	{
		$this->collsfSimpleForumTopicViews[] = $l;
		$l->setsfSimpleForumTopic($this);
	}


	
	public function getsfSimpleForumTopicViewsJoinAccount($criteria = null, $con = null)
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

				$criteria->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $this->getId());

				$this->collsfSimpleForumTopicViews = sfSimpleForumTopicViewPeer::doSelectJoinAccount($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumTopicViewCriteria) || !$this->lastsfSimpleForumTopicViewCriteria->equals($criteria)) {
				$this->collsfSimpleForumTopicViews = sfSimpleForumTopicViewPeer::doSelectJoinAccount($criteria, $con);
			}
		}
		$this->lastsfSimpleForumTopicViewCriteria = $criteria;

		return $this->collsfSimpleForumTopicViews;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasesfSimpleForumTopic:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasesfSimpleForumTopic::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 