<?php


abstract class BasesfSimpleForumForum extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $description;


	
	protected $rank;


	
	protected $category_id;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $stripped_name;


	
	protected $latest_post_id;


	
	protected $nb_posts;


	
	protected $nb_topics;

	
	protected $asfSimpleForumCategory;

	
	protected $asfSimpleForumPost;

	
	protected $collsfSimpleForumTopics;

	
	protected $lastsfSimpleForumTopicCriteria = null;

	
	protected $collsfSimpleForumPosts;

	
	protected $lastsfSimpleForumPostCriteria = null;

	
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

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getRank()
	{

		return $this->rank;
	}

	
	public function getCategoryId()
	{

		return $this->category_id;
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

	
	public function getStrippedName()
	{

		return $this->stripped_name;
	}

	
	public function getLatestPostId()
	{

		return $this->latest_post_id;
	}

	
	public function getNbPosts()
	{

		return $this->nb_posts;
	}

	
	public function getNbTopics()
	{

		return $this->nb_topics;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::ID;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::DESCRIPTION;
		}

	} 
	
	public function setRank($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->rank !== $v) {
			$this->rank = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::RANK;
		}

	} 
	
	public function setCategoryId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->category_id !== $v) {
			$this->category_id = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::CATEGORY_ID;
		}

		if ($this->asfSimpleForumCategory !== null && $this->asfSimpleForumCategory->getId() !== $v) {
			$this->asfSimpleForumCategory = null;
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
			$this->modifiedColumns[] = sfSimpleForumForumPeer::CREATED_AT;
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
			$this->modifiedColumns[] = sfSimpleForumForumPeer::UPDATED_AT;
		}

	} 
	
	public function setStrippedName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stripped_name !== $v) {
			$this->stripped_name = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::STRIPPED_NAME;
		}

	} 
	
	public function setLatestPostId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->latest_post_id !== $v) {
			$this->latest_post_id = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::LATEST_POST_ID;
		}

		if ($this->asfSimpleForumPost !== null && $this->asfSimpleForumPost->getId() !== $v) {
			$this->asfSimpleForumPost = null;
		}

	} 
	
	public function setNbPosts($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nb_posts !== $v) {
			$this->nb_posts = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::NB_POSTS;
		}

	} 
	
	public function setNbTopics($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nb_topics !== $v) {
			$this->nb_topics = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::NB_TOPICS;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->rank = $rs->getInt($startcol + 3);

			$this->category_id = $rs->getInt($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->stripped_name = $rs->getString($startcol + 7);

			$this->latest_post_id = $rs->getInt($startcol + 8);

			$this->nb_posts = $rs->getString($startcol + 9);

			$this->nb_topics = $rs->getString($startcol + 10);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating sfSimpleForumForum object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumForum:delete:pre') as $callable)
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
			$con = Propel::getConnection(sfSimpleForumForumPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			sfSimpleForumForumPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasesfSimpleForumForum:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumForum:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(sfSimpleForumForumPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(sfSimpleForumForumPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumForumPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasesfSimpleForumForum:save:post') as $callable)
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


												
			if ($this->asfSimpleForumCategory !== null) {
				if ($this->asfSimpleForumCategory->isModified()) {
					$affectedRows += $this->asfSimpleForumCategory->save($con);
				}
				$this->setsfSimpleForumCategory($this->asfSimpleForumCategory);
			}

			if ($this->asfSimpleForumPost !== null) {
				if ($this->asfSimpleForumPost->isModified()) {
					$affectedRows += $this->asfSimpleForumPost->save($con);
				}
				$this->setsfSimpleForumPost($this->asfSimpleForumPost);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfSimpleForumForumPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += sfSimpleForumForumPeer::doUpdate($this, $con);
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


												
			if ($this->asfSimpleForumCategory !== null) {
				if (!$this->asfSimpleForumCategory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfSimpleForumCategory->getValidationFailures());
				}
			}

			if ($this->asfSimpleForumPost !== null) {
				if (!$this->asfSimpleForumPost->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfSimpleForumPost->getValidationFailures());
				}
			}


			if (($retval = sfSimpleForumForumPeer::doValidate($this, $columns)) !== true) {
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


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfSimpleForumForumPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDescription();
				break;
			case 3:
				return $this->getRank();
				break;
			case 4:
				return $this->getCategoryId();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			case 7:
				return $this->getStrippedName();
				break;
			case 8:
				return $this->getLatestPostId();
				break;
			case 9:
				return $this->getNbPosts();
				break;
			case 10:
				return $this->getNbTopics();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfSimpleForumForumPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getRank(),
			$keys[4] => $this->getCategoryId(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
			$keys[7] => $this->getStrippedName(),
			$keys[8] => $this->getLatestPostId(),
			$keys[9] => $this->getNbPosts(),
			$keys[10] => $this->getNbTopics(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfSimpleForumForumPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDescription($value);
				break;
			case 3:
				$this->setRank($value);
				break;
			case 4:
				$this->setCategoryId($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
			case 7:
				$this->setStrippedName($value);
				break;
			case 8:
				$this->setLatestPostId($value);
				break;
			case 9:
				$this->setNbPosts($value);
				break;
			case 10:
				$this->setNbTopics($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfSimpleForumForumPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRank($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCategoryId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setStrippedName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setLatestPostId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setNbPosts($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setNbTopics($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);

		if ($this->isColumnModified(sfSimpleForumForumPeer::ID)) $criteria->add(sfSimpleForumForumPeer::ID, $this->id);
		if ($this->isColumnModified(sfSimpleForumForumPeer::NAME)) $criteria->add(sfSimpleForumForumPeer::NAME, $this->name);
		if ($this->isColumnModified(sfSimpleForumForumPeer::DESCRIPTION)) $criteria->add(sfSimpleForumForumPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(sfSimpleForumForumPeer::RANK)) $criteria->add(sfSimpleForumForumPeer::RANK, $this->rank);
		if ($this->isColumnModified(sfSimpleForumForumPeer::CATEGORY_ID)) $criteria->add(sfSimpleForumForumPeer::CATEGORY_ID, $this->category_id);
		if ($this->isColumnModified(sfSimpleForumForumPeer::CREATED_AT)) $criteria->add(sfSimpleForumForumPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(sfSimpleForumForumPeer::UPDATED_AT)) $criteria->add(sfSimpleForumForumPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(sfSimpleForumForumPeer::STRIPPED_NAME)) $criteria->add(sfSimpleForumForumPeer::STRIPPED_NAME, $this->stripped_name);
		if ($this->isColumnModified(sfSimpleForumForumPeer::LATEST_POST_ID)) $criteria->add(sfSimpleForumForumPeer::LATEST_POST_ID, $this->latest_post_id);
		if ($this->isColumnModified(sfSimpleForumForumPeer::NB_POSTS)) $criteria->add(sfSimpleForumForumPeer::NB_POSTS, $this->nb_posts);
		if ($this->isColumnModified(sfSimpleForumForumPeer::NB_TOPICS)) $criteria->add(sfSimpleForumForumPeer::NB_TOPICS, $this->nb_topics);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);

		$criteria->add(sfSimpleForumForumPeer::ID, $this->id);

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

		$copyObj->setDescription($this->description);

		$copyObj->setRank($this->rank);

		$copyObj->setCategoryId($this->category_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setStrippedName($this->stripped_name);

		$copyObj->setLatestPostId($this->latest_post_id);

		$copyObj->setNbPosts($this->nb_posts);

		$copyObj->setNbTopics($this->nb_topics);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getsfSimpleForumTopics() as $relObj) {
				$copyObj->addsfSimpleForumTopic($relObj->copy($deepCopy));
			}

			foreach($this->getsfSimpleForumPosts() as $relObj) {
				$copyObj->addsfSimpleForumPost($relObj->copy($deepCopy));
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
			self::$peer = new sfSimpleForumForumPeer();
		}
		return self::$peer;
	}

	
	public function setsfSimpleForumCategory($v)
	{


		if ($v === null) {
			$this->setCategoryId(NULL);
		} else {
			$this->setCategoryId($v->getId());
		}


		$this->asfSimpleForumCategory = $v;
	}


	
	public function getsfSimpleForumCategory($con = null)
	{
		if ($this->asfSimpleForumCategory === null && ($this->category_id !== null)) {
						include_once 'plugins/sfSimpleForumPlugin/lib/model/om/BasesfSimpleForumCategoryPeer.php';

			$this->asfSimpleForumCategory = sfSimpleForumCategoryPeer::retrieveByPK($this->category_id, $con);

			
		}
		return $this->asfSimpleForumCategory;
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

				$criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->getId());

				sfSimpleForumTopicPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->getId());

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

		$criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->getId());

		return sfSimpleForumTopicPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfSimpleForumTopic(sfSimpleForumTopic $l)
	{
		$this->collsfSimpleForumTopics[] = $l;
		$l->setsfSimpleForumForum($this);
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

				$criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->getId());

				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfSimpleForumPost($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumTopicCriteria) || !$this->lastsfSimpleForumTopicCriteria->equals($criteria)) {
				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfSimpleForumPost($criteria, $con);
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

				$criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->getId());

				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinAccount($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumTopicCriteria) || !$this->lastsfSimpleForumTopicCriteria->equals($criteria)) {
				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinAccount($criteria, $con);
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

				$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->getId());

				sfSimpleForumPostPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->getId());

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

		$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->getId());

		return sfSimpleForumPostPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsfSimpleForumPost(sfSimpleForumPost $l)
	{
		$this->collsfSimpleForumPosts[] = $l;
		$l->setsfSimpleForumForum($this);
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

				$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->getId());

				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumTopic($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumTopic($criteria, $con);
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;

		return $this->collsfSimpleForumPosts;
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

				$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->getId());

				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinAccount($criteria, $con);
			}
		} else {
									
			$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->getId());

			if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinAccount($criteria, $con);
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;

		return $this->collsfSimpleForumPosts;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasesfSimpleForumForum:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasesfSimpleForumForum::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 