<?php


abstract class BaseGame extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $privileges_level = 2;


	
	protected $api_key;


	
	protected $name;


	
	protected $description;


	
	protected $thumbnail_path;


	
	protected $url;


	
	protected $width;


	
	protected $height;


	
	protected $bgcolor;


	
	protected $gameplays = 0;

	
	protected $collComments;

	
	protected $lastCommentCriteria = null;

	
	protected $collGameStats;

	
	protected $lastGameStatCriteria = null;

	
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

	
	public function getThumbnailPath()
	{

		return $this->thumbnail_path;
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

	
	public function getGameplays()
	{

		return $this->gameplays;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = GamePeer::ID;
		}

	} 
	
	public function setPrivilegesLevel($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->privileges_level !== $v || $v === 2) {
			$this->privileges_level = $v;
			$this->modifiedColumns[] = GamePeer::PRIVILEGES_LEVEL;
		}

	} 
	
	public function setApiKey($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->api_key !== $v) {
			$this->api_key = $v;
			$this->modifiedColumns[] = GamePeer::API_KEY;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = GamePeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = GamePeer::DESCRIPTION;
		}

	} 
	
	public function setThumbnailPath($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->thumbnail_path !== $v) {
			$this->thumbnail_path = $v;
			$this->modifiedColumns[] = GamePeer::THUMBNAIL_PATH;
		}

	} 
	
	public function setUrl($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = GamePeer::URL;
		}

	} 
	
	public function setWidth($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->width !== $v) {
			$this->width = $v;
			$this->modifiedColumns[] = GamePeer::WIDTH;
		}

	} 
	
	public function setHeight($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->height !== $v) {
			$this->height = $v;
			$this->modifiedColumns[] = GamePeer::HEIGHT;
		}

	} 
	
	public function setBgcolor($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->bgcolor !== $v) {
			$this->bgcolor = $v;
			$this->modifiedColumns[] = GamePeer::BGCOLOR;
		}

	} 
	
	public function setGameplays($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->gameplays !== $v || $v === 0) {
			$this->gameplays = $v;
			$this->modifiedColumns[] = GamePeer::GAMEPLAYS;
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

			$this->thumbnail_path = $rs->getString($startcol + 5);

			$this->url = $rs->getString($startcol + 6);

			$this->width = $rs->getInt($startcol + 7);

			$this->height = $rs->getInt($startcol + 8);

			$this->bgcolor = $rs->getString($startcol + 9);

			$this->gameplays = $rs->getInt($startcol + 10);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Game object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseGame:delete:pre') as $callable)
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
			$con = Propel::getConnection(GamePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			GamePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseGame:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseGame:save:pre') as $callable)
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
			$con = Propel::getConnection(GamePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseGame:save:post') as $callable)
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
					$pk = GamePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += GamePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collComments !== null) {
				foreach($this->collComments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGameStats !== null) {
				foreach($this->collGameStats as $referrerFK) {
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


			if (($retval = GamePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collComments !== null) {
					foreach($this->collComments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGameStats !== null) {
					foreach($this->collGameStats as $referrerFK) {
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
		$pos = GamePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getThumbnailPath();
				break;
			case 6:
				return $this->getUrl();
				break;
			case 7:
				return $this->getWidth();
				break;
			case 8:
				return $this->getHeight();
				break;
			case 9:
				return $this->getBgcolor();
				break;
			case 10:
				return $this->getGameplays();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GamePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPrivilegesLevel(),
			$keys[2] => $this->getApiKey(),
			$keys[3] => $this->getName(),
			$keys[4] => $this->getDescription(),
			$keys[5] => $this->getThumbnailPath(),
			$keys[6] => $this->getUrl(),
			$keys[7] => $this->getWidth(),
			$keys[8] => $this->getHeight(),
			$keys[9] => $this->getBgcolor(),
			$keys[10] => $this->getGameplays(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GamePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setThumbnailPath($value);
				break;
			case 6:
				$this->setUrl($value);
				break;
			case 7:
				$this->setWidth($value);
				break;
			case 8:
				$this->setHeight($value);
				break;
			case 9:
				$this->setBgcolor($value);
				break;
			case 10:
				$this->setGameplays($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GamePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPrivilegesLevel($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setApiKey($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDescription($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setThumbnailPath($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUrl($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setWidth($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setHeight($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setBgcolor($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setGameplays($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(GamePeer::DATABASE_NAME);

		if ($this->isColumnModified(GamePeer::ID)) $criteria->add(GamePeer::ID, $this->id);
		if ($this->isColumnModified(GamePeer::PRIVILEGES_LEVEL)) $criteria->add(GamePeer::PRIVILEGES_LEVEL, $this->privileges_level);
		if ($this->isColumnModified(GamePeer::API_KEY)) $criteria->add(GamePeer::API_KEY, $this->api_key);
		if ($this->isColumnModified(GamePeer::NAME)) $criteria->add(GamePeer::NAME, $this->name);
		if ($this->isColumnModified(GamePeer::DESCRIPTION)) $criteria->add(GamePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(GamePeer::THUMBNAIL_PATH)) $criteria->add(GamePeer::THUMBNAIL_PATH, $this->thumbnail_path);
		if ($this->isColumnModified(GamePeer::URL)) $criteria->add(GamePeer::URL, $this->url);
		if ($this->isColumnModified(GamePeer::WIDTH)) $criteria->add(GamePeer::WIDTH, $this->width);
		if ($this->isColumnModified(GamePeer::HEIGHT)) $criteria->add(GamePeer::HEIGHT, $this->height);
		if ($this->isColumnModified(GamePeer::BGCOLOR)) $criteria->add(GamePeer::BGCOLOR, $this->bgcolor);
		if ($this->isColumnModified(GamePeer::GAMEPLAYS)) $criteria->add(GamePeer::GAMEPLAYS, $this->gameplays);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(GamePeer::DATABASE_NAME);

		$criteria->add(GamePeer::ID, $this->id);

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

		$copyObj->setThumbnailPath($this->thumbnail_path);

		$copyObj->setUrl($this->url);

		$copyObj->setWidth($this->width);

		$copyObj->setHeight($this->height);

		$copyObj->setBgcolor($this->bgcolor);

		$copyObj->setGameplays($this->gameplays);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getComments() as $relObj) {
				$copyObj->addComment($relObj->copy($deepCopy));
			}

			foreach($this->getGameStats() as $relObj) {
				$copyObj->addGameStat($relObj->copy($deepCopy));
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
			self::$peer = new GamePeer();
		}
		return self::$peer;
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

				$criteria->add(CommentPeer::ID_GAME, $this->getId());

				CommentPeer::addSelectColumns($criteria);
				$this->collComments = CommentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CommentPeer::ID_GAME, $this->getId());

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

		$criteria->add(CommentPeer::ID_GAME, $this->getId());

		return CommentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addComment(Comment $l)
	{
		$this->collComments[] = $l;
		$l->setGame($this);
	}


	
	public function getCommentsJoinAvatar($criteria = null, $con = null)
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

				$criteria->add(CommentPeer::ID_GAME, $this->getId());

				$this->collComments = CommentPeer::doSelectJoinAvatar($criteria, $con);
			}
		} else {
									
			$criteria->add(CommentPeer::ID_GAME, $this->getId());

			if (!isset($this->lastCommentCriteria) || !$this->lastCommentCriteria->equals($criteria)) {
				$this->collComments = CommentPeer::doSelectJoinAvatar($criteria, $con);
			}
		}
		$this->lastCommentCriteria = $criteria;

		return $this->collComments;
	}

	
	public function initGameStats()
	{
		if ($this->collGameStats === null) {
			$this->collGameStats = array();
		}
	}

	
	public function getGameStats($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseGameStatPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGameStats === null) {
			if ($this->isNew()) {
			   $this->collGameStats = array();
			} else {

				$criteria->add(GameStatPeer::GAME_ID, $this->getId());

				GameStatPeer::addSelectColumns($criteria);
				$this->collGameStats = GameStatPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(GameStatPeer::GAME_ID, $this->getId());

				GameStatPeer::addSelectColumns($criteria);
				if (!isset($this->lastGameStatCriteria) || !$this->lastGameStatCriteria->equals($criteria)) {
					$this->collGameStats = GameStatPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGameStatCriteria = $criteria;
		return $this->collGameStats;
	}

	
	public function countGameStats($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseGameStatPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(GameStatPeer::GAME_ID, $this->getId());

		return GameStatPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addGameStat(GameStat $l)
	{
		$this->collGameStats[] = $l;
		$l->setGame($this);
	}


	
	public function getGameStatsJoinGameStatType($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseGameStatPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGameStats === null) {
			if ($this->isNew()) {
				$this->collGameStats = array();
			} else {

				$criteria->add(GameStatPeer::GAME_ID, $this->getId());

				$this->collGameStats = GameStatPeer::doSelectJoinGameStatType($criteria, $con);
			}
		} else {
									
			$criteria->add(GameStatPeer::GAME_ID, $this->getId());

			if (!isset($this->lastGameStatCriteria) || !$this->lastGameStatCriteria->equals($criteria)) {
				$this->collGameStats = GameStatPeer::doSelectJoinGameStatType($criteria, $con);
			}
		}
		$this->lastGameStatCriteria = $criteria;

		return $this->collGameStats;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseGame:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseGame::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 