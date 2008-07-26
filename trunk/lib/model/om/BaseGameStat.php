<?php


abstract class BaseGameStat extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $game_id;


	
	protected $gamestattype_id;


	
	protected $name;


	
	protected $description;

	
	protected $aGame;

	
	protected $aGameStatType;

	
	protected $collGameStat_Avatars;

	
	protected $lastGameStat_AvatarCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getGameId()
	{

		return $this->game_id;
	}

	
	public function getGamestattypeId()
	{

		return $this->gamestattype_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = GameStatPeer::ID;
		}

	} 
	
	public function setGameId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->game_id !== $v) {
			$this->game_id = $v;
			$this->modifiedColumns[] = GameStatPeer::GAME_ID;
		}

		if ($this->aGame !== null && $this->aGame->getId() !== $v) {
			$this->aGame = null;
		}

	} 
	
	public function setGamestattypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->gamestattype_id !== $v) {
			$this->gamestattype_id = $v;
			$this->modifiedColumns[] = GameStatPeer::GAMESTATTYPE_ID;
		}

		if ($this->aGameStatType !== null && $this->aGameStatType->getId() !== $v) {
			$this->aGameStatType = null;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = GameStatPeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = GameStatPeer::DESCRIPTION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->game_id = $rs->getInt($startcol + 1);

			$this->gamestattype_id = $rs->getInt($startcol + 2);

			$this->name = $rs->getString($startcol + 3);

			$this->description = $rs->getString($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating GameStat object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseGameStat:delete:pre') as $callable)
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
			$con = Propel::getConnection(GameStatPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			GameStatPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseGameStat:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseGameStat:save:pre') as $callable)
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
			$con = Propel::getConnection(GameStatPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseGameStat:save:post') as $callable)
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


												
			if ($this->aGame !== null) {
				if ($this->aGame->isModified()) {
					$affectedRows += $this->aGame->save($con);
				}
				$this->setGame($this->aGame);
			}

			if ($this->aGameStatType !== null) {
				if ($this->aGameStatType->isModified()) {
					$affectedRows += $this->aGameStatType->save($con);
				}
				$this->setGameStatType($this->aGameStatType);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = GameStatPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += GameStatPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aGame !== null) {
				if (!$this->aGame->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aGame->getValidationFailures());
				}
			}

			if ($this->aGameStatType !== null) {
				if (!$this->aGameStatType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aGameStatType->getValidationFailures());
				}
			}


			if (($retval = GameStatPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = GameStatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getGameId();
				break;
			case 2:
				return $this->getGamestattypeId();
				break;
			case 3:
				return $this->getName();
				break;
			case 4:
				return $this->getDescription();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GameStatPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getGameId(),
			$keys[2] => $this->getGamestattypeId(),
			$keys[3] => $this->getName(),
			$keys[4] => $this->getDescription(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GameStatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setGameId($value);
				break;
			case 2:
				$this->setGamestattypeId($value);
				break;
			case 3:
				$this->setName($value);
				break;
			case 4:
				$this->setDescription($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GameStatPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setGameId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setGamestattypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDescription($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(GameStatPeer::DATABASE_NAME);

		if ($this->isColumnModified(GameStatPeer::ID)) $criteria->add(GameStatPeer::ID, $this->id);
		if ($this->isColumnModified(GameStatPeer::GAME_ID)) $criteria->add(GameStatPeer::GAME_ID, $this->game_id);
		if ($this->isColumnModified(GameStatPeer::GAMESTATTYPE_ID)) $criteria->add(GameStatPeer::GAMESTATTYPE_ID, $this->gamestattype_id);
		if ($this->isColumnModified(GameStatPeer::NAME)) $criteria->add(GameStatPeer::NAME, $this->name);
		if ($this->isColumnModified(GameStatPeer::DESCRIPTION)) $criteria->add(GameStatPeer::DESCRIPTION, $this->description);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(GameStatPeer::DATABASE_NAME);

		$criteria->add(GameStatPeer::ID, $this->id);

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

		$copyObj->setGameId($this->game_id);

		$copyObj->setGamestattypeId($this->gamestattype_id);

		$copyObj->setName($this->name);

		$copyObj->setDescription($this->description);


		if ($deepCopy) {
									$copyObj->setNew(false);

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
			self::$peer = new GameStatPeer();
		}
		return self::$peer;
	}

	
	public function setGame($v)
	{


		if ($v === null) {
			$this->setGameId(NULL);
		} else {
			$this->setGameId($v->getId());
		}


		$this->aGame = $v;
	}


	
	public function getGame($con = null)
	{
		if ($this->aGame === null && ($this->game_id !== null)) {
						include_once 'lib/model/om/BaseGamePeer.php';

			$this->aGame = GamePeer::retrieveByPK($this->game_id, $con);

			
		}
		return $this->aGame;
	}

	
	public function setGameStatType($v)
	{


		if ($v === null) {
			$this->setGamestattypeId(NULL);
		} else {
			$this->setGamestattypeId($v->getId());
		}


		$this->aGameStatType = $v;
	}


	
	public function getGameStatType($con = null)
	{
		if ($this->aGameStatType === null && ($this->gamestattype_id !== null)) {
						include_once 'lib/model/om/BaseGameStatTypePeer.php';

			$this->aGameStatType = GameStatTypePeer::retrieveByPK($this->gamestattype_id, $con);

			
		}
		return $this->aGameStatType;
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

				$criteria->add(GameStat_AvatarPeer::GAMESTAT_ID, $this->getId());

				GameStat_AvatarPeer::addSelectColumns($criteria);
				$this->collGameStat_Avatars = GameStat_AvatarPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(GameStat_AvatarPeer::GAMESTAT_ID, $this->getId());

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

		$criteria->add(GameStat_AvatarPeer::GAMESTAT_ID, $this->getId());

		return GameStat_AvatarPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addGameStat_Avatar(GameStat_Avatar $l)
	{
		$this->collGameStat_Avatars[] = $l;
		$l->setGameStat($this);
	}


	
	public function getGameStat_AvatarsJoinAvatar($criteria = null, $con = null)
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

				$criteria->add(GameStat_AvatarPeer::GAMESTAT_ID, $this->getId());

				$this->collGameStat_Avatars = GameStat_AvatarPeer::doSelectJoinAvatar($criteria, $con);
			}
		} else {
									
			$criteria->add(GameStat_AvatarPeer::GAMESTAT_ID, $this->getId());

			if (!isset($this->lastGameStat_AvatarCriteria) || !$this->lastGameStat_AvatarCriteria->equals($criteria)) {
				$this->collGameStat_Avatars = GameStat_AvatarPeer::doSelectJoinAvatar($criteria, $con);
			}
		}
		$this->lastGameStat_AvatarCriteria = $criteria;

		return $this->collGameStat_Avatars;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseGameStat:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseGameStat::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 