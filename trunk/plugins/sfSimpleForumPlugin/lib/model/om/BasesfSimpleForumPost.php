<?php


abstract class BasesfSimpleForumPost extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $title;


	
	protected $content;


	
	protected $topic_id;


	
	protected $user_id;


	
	protected $created_at;


	
	protected $forum_id;


	
	protected $author_name;

	
	protected $asfSimpleForumTopic;

	
	protected $aAccount;

	
	protected $asfSimpleForumForum;

	
	protected $collsfSimpleForumForums;

	
	protected $lastsfSimpleForumForumCriteria = null;

	
	protected $collsfSimpleForumTopics;

	
	protected $lastsfSimpleForumTopicCriteria = null;

	
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

	
	public function getContent()
	{

		return $this->content;
	}

	
	public function getTopicId()
	{

		return $this->topic_id;
	}

	
	public function getUserId()
	{

		return $this->user_id;
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

	
	public function getForumId()
	{

		return $this->forum_id;
	}

	
	public function getAuthorName()
	{

		return $this->author_name;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::ID;
		}

	} 
	
	public function setTitle($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::TITLE;
		}

	} 
	
	public function setContent($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::CONTENT;
		}

	} 
	
	public function setTopicId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->topic_id !== $v) {
			$this->topic_id = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::TOPIC_ID;
		}

		if ($this->asfSimpleForumTopic !== null && $this->asfSimpleForumTopic->getId() !== $v) {
			$this->asfSimpleForumTopic = null;
		}

	} 
	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::USER_ID;
		}

		if ($this->aAccount !== null && $this->aAccount->getId() !== $v) {
			$this->aAccount = null;
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
			$this->modifiedColumns[] = sfSimpleForumPostPeer::CREATED_AT;
		}

	} 
	
	public function setForumId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->forum_id !== $v) {
			$this->forum_id = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::FORUM_ID;
		}

		if ($this->asfSimpleForumForum !== null && $this->asfSimpleForumForum->getId() !== $v) {
			$this->asfSimpleForumForum = null;
		}

	} 
	
	public function setAuthorName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->author_name !== $v) {
			$this->author_name = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::AUTHOR_NAME;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->title = $rs->getString($startcol + 1);

			$this->content = $rs->getString($startcol + 2);

			$this->topic_id = $rs->getInt($startcol + 3);

			$this->user_id = $rs->getInt($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->forum_id = $rs->getInt($startcol + 6);

			$this->author_name = $rs->getString($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating sfSimpleForumPost object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumPost:delete:pre') as $callable)
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
			$con = Propel::getConnection(sfSimpleForumPostPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			sfSimpleForumPostPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasesfSimpleForumPost:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumPost:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(sfSimpleForumPostPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumPostPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasesfSimpleForumPost:save:post') as $callable)
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


												
			if ($this->asfSimpleForumTopic !== null) {
				if ($this->asfSimpleForumTopic->isModified()) {
					$affectedRows += $this->asfSimpleForumTopic->save($con);
				}
				$this->setsfSimpleForumTopic($this->asfSimpleForumTopic);
			}

			if ($this->aAccount !== null) {
				if ($this->aAccount->isModified()) {
					$affectedRows += $this->aAccount->save($con);
				}
				$this->setAccount($this->aAccount);
			}

			if ($this->asfSimpleForumForum !== null) {
				if ($this->asfSimpleForumForum->isModified()) {
					$affectedRows += $this->asfSimpleForumForum->save($con);
				}
				$this->setsfSimpleForumForum($this->asfSimpleForumForum);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfSimpleForumPostPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += sfSimpleForumPostPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collsfSimpleForumForums !== null) {
				foreach($this->collsfSimpleForumForums as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfSimpleForumTopics !== null) {
				foreach($this->collsfSimpleForumTopics as $referrerFK) {
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


												
			if ($this->asfSimpleForumTopic !== null) {
				if (!$this->asfSimpleForumTopic->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfSimpleForumTopic->getValidationFailures());
				}
			}

			if ($this->aAccount !== null) {
				if (!$this->aAccount->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAccount->getValidationFailures());
				}
			}

			if ($this->asfSimpleForumForum !== null) {
				if (!$this->asfSimpleForumForum->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfSimpleForumForum->getValidationFailures());
				}
			}


			if (($retval = sfSimpleForumPostPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfSimpleForumForums !== null) {
					foreach($this->collsfSimpleForumForums as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfSimpleForumTopics !== null) {
					foreach($this->collsfSimpleForumTopics as $referrerFK) {
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
		$pos = sfSimpleForumPostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getContent();
				break;
			case 3:
				return $this->getTopicId();
				break;
			case 4:
				return $this->getUserId();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getForumId();
				break;
			case 7:
				return $this->getAuthorName();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfSimpleForumPostPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getContent(),
			$keys[3] => $this->getTopicId(),
			$keys[4] => $this->getUserId(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getForumId(),
			$keys[7] => $this->getAuthorName(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfSimpleForumPostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setContent($value);
				break;
			case 3:
				$this->setTopicId($value);
				break;
			case 4:
				$this->setUserId($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setForumId($value);
				break;
			case 7:
				$this->setAuthorName($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfSimpleForumPostPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setContent($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTopicId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUserId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setForumId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setAuthorName($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);

		if ($this->isColumnModified(sfSimpleForumPostPeer::ID)) $criteria->add(sfSimpleForumPostPeer::ID, $this->id);
		if ($this->isColumnModified(sfSimpleForumPostPeer::TITLE)) $criteria->add(sfSimpleForumPostPeer::TITLE, $this->title);
		if ($this->isColumnModified(sfSimpleForumPostPeer::CONTENT)) $criteria->add(sfSimpleForumPostPeer::CONTENT, $this->content);
		if ($this->isColumnModified(sfSimpleForumPostPeer::TOPIC_ID)) $criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->topic_id);
		if ($this->isColumnModified(sfSimpleForumPostPeer::USER_ID)) $criteria->add(sfSimpleForumPostPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(sfSimpleForumPostPeer::CREATED_AT)) $criteria->add(sfSimpleForumPostPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(sfSimpleForumPostPeer::FORUM_ID)) $criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->forum_id);
		if ($this->isColumnModified(sfSimpleForumPostPeer::AUTHOR_NAME)) $criteria->add(sfSimpleForumPostPeer::AUTHOR_NAME, $this->author_name);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);

		$criteria->add(sfSimpleForumPostPeer::ID, $this->id);

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

		$copyObj->setContent($this->content);

		$copyObj->setTopicId($this->topic_id);

		$copyObj->setUserId($this->user_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setForumId($this->forum_id);

		$copyObj->setAuthorName($this->author_name);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getsfSimpleForumForums() as $relObj) {
				$copyObj->addsfSimpleForumForum($relObj->copy($deepCopy));
			}

			foreach($this->getsfSimpleForumTopics() as $relObj) {
				$copyObj->addsfSimpleForumTopic($relObj->copy($deepCopy));
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
			self::$peer = new sfSimpleForumPostPeer();
		}
		return self::$peer;
	}

	
	public function setsfSimpleForumTopic($v)
	{


		if ($v === null) {
			$this->setTopicId(NULL);
		} else {
			$this->setTopicId($v->getId());
		}


		$this->asfSimpleForumTopic = $v;
	}


	
	public function getsfSimpleForumTopic($con = null)
	{
		if ($this->asfSimpleForumTopic === null && ($this->topic_id !== null)) {
						include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumTopicPeer.php';

			$this->asfSimpleForumTopic = sfSimpleForumTopicPeer::retrieveByPK($this->topic_id, $con);

			
		}
		return $this->asfSimpleForumTopic;
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

				$criteria->add(sfSimpleForumForumPeer::LATEST_POST_ID, $this->getId());

				sfSimpleForumForumPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumForums = sfSimpleForumForumPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfSimpleForumForumPeer::LATEST_POST_ID, $this->getId());

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

		$criteria->add(sfSimpleForumForumPeer::LATEST_POST_ID, $this->getId());

		return sfSimpleForumForumPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfSimpleForumForum(sfSimpleForumForum $l)
	{
		$this->collsfSimpleForumForums[] = $l;
		$l->setsfSimpleForumPost($this);
	}


	
	public function getsfSimpleForumForumsJoinsfSimpleForumCategory($criteria = null, $con = null)
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

				$criteria->add(sfSimpleForumForumPeer::LATEST_POST_ID, $this->getId());

				$this->collsfSimpleForumForums = sfSimpleForumForumPeer::doSelectJoinsfSimpleForumCategory($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumForumPeer::LATEST_POST_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumForumCriteria) || !$this->lastsfSimpleForumForumCriteria->equals($criteria)) {
				$this->collsfSimpleForumForums = sfSimpleForumForumPeer::doSelectJoinsfSimpleForumCategory($criteria, $con);
			}
		}
		$this->lastsfSimpleForumForumCriteria = $criteria;

		return $this->collsfSimpleForumForums;
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

				$criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->getId());

				sfSimpleForumTopicPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->getId());

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

		$criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->getId());

		return sfSimpleForumTopicPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfSimpleForumTopic(sfSimpleForumTopic $l)
	{
		$this->collsfSimpleForumTopics[] = $l;
		$l->setsfSimpleForumPost($this);
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

				$criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->getId());

				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfSimpleForumForum($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumTopicCriteria) || !$this->lastsfSimpleForumTopicCriteria->equals($criteria)) {
				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfSimpleForumForum($criteria, $con);
			}
		}
		$this->lastsfSimpleForumTopicCriteria = $criteria;

		return $this->collsfSimpleForumTopics;
	}


	
	public function getsfSimpleForumTopicsJoinAccount($criteria = null, $con = null)
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

				$criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->getId());

				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinAccount($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumTopicCriteria) || !$this->lastsfSimpleForumTopicCriteria->equals($criteria)) {
				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinAccount($criteria, $con);
			}
		}
		$this->lastsfSimpleForumTopicCriteria = $criteria;

		return $this->collsfSimpleForumTopics;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasesfSimpleForumPost:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasesfSimpleForumPost::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 