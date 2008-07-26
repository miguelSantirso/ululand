<?php


abstract class BaseComment extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_avatar;


	
	protected $id_game;


	
	protected $text;


	
	protected $created_at;

	
	protected $aGame;

	
	protected $aAvatar;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdAvatar()
	{

		return $this->id_avatar;
	}

	
	public function getIdGame()
	{

		return $this->id_game;
	}

	
	public function getText()
	{

		return $this->text;
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
			$this->modifiedColumns[] = CommentPeer::ID;
		}

	} 
	
	public function setIdAvatar($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_avatar !== $v) {
			$this->id_avatar = $v;
			$this->modifiedColumns[] = CommentPeer::ID_AVATAR;
		}

		if ($this->aAvatar !== null && $this->aAvatar->getId() !== $v) {
			$this->aAvatar = null;
		}

	} 
	
	public function setIdGame($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_game !== $v) {
			$this->id_game = $v;
			$this->modifiedColumns[] = CommentPeer::ID_GAME;
		}

		if ($this->aGame !== null && $this->aGame->getId() !== $v) {
			$this->aGame = null;
		}

	} 
	
	public function setText($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->text !== $v) {
			$this->text = $v;
			$this->modifiedColumns[] = CommentPeer::TEXT;
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
			$this->modifiedColumns[] = CommentPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->id_avatar = $rs->getInt($startcol + 1);

			$this->id_game = $rs->getInt($startcol + 2);

			$this->text = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Comment object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseComment:delete:pre') as $callable)
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
			$con = Propel::getConnection(CommentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CommentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseComment:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseComment:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(CommentPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CommentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseComment:save:post') as $callable)
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

			if ($this->aAvatar !== null) {
				if ($this->aAvatar->isModified()) {
					$affectedRows += $this->aAvatar->save($con);
				}
				$this->setAvatar($this->aAvatar);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CommentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CommentPeer::doUpdate($this, $con);
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


												
			if ($this->aGame !== null) {
				if (!$this->aGame->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aGame->getValidationFailures());
				}
			}

			if ($this->aAvatar !== null) {
				if (!$this->aAvatar->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAvatar->getValidationFailures());
				}
			}


			if (($retval = CommentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CommentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdAvatar();
				break;
			case 2:
				return $this->getIdGame();
				break;
			case 3:
				return $this->getText();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CommentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdAvatar(),
			$keys[2] => $this->getIdGame(),
			$keys[3] => $this->getText(),
			$keys[4] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CommentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdAvatar($value);
				break;
			case 2:
				$this->setIdGame($value);
				break;
			case 3:
				$this->setText($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CommentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdAvatar($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdGame($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setText($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CommentPeer::DATABASE_NAME);

		if ($this->isColumnModified(CommentPeer::ID)) $criteria->add(CommentPeer::ID, $this->id);
		if ($this->isColumnModified(CommentPeer::ID_AVATAR)) $criteria->add(CommentPeer::ID_AVATAR, $this->id_avatar);
		if ($this->isColumnModified(CommentPeer::ID_GAME)) $criteria->add(CommentPeer::ID_GAME, $this->id_game);
		if ($this->isColumnModified(CommentPeer::TEXT)) $criteria->add(CommentPeer::TEXT, $this->text);
		if ($this->isColumnModified(CommentPeer::CREATED_AT)) $criteria->add(CommentPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CommentPeer::DATABASE_NAME);

		$criteria->add(CommentPeer::ID, $this->id);

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

		$copyObj->setIdAvatar($this->id_avatar);

		$copyObj->setIdGame($this->id_game);

		$copyObj->setText($this->text);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new CommentPeer();
		}
		return self::$peer;
	}

	
	public function setGame($v)
	{


		if ($v === null) {
			$this->setIdGame(NULL);
		} else {
			$this->setIdGame($v->getId());
		}


		$this->aGame = $v;
	}


	
	public function getGame($con = null)
	{
		if ($this->aGame === null && ($this->id_game !== null)) {
						include_once 'lib/model/om/BaseGamePeer.php';

			$this->aGame = GamePeer::retrieveByPK($this->id_game, $con);

			
		}
		return $this->aGame;
	}

	
	public function setAvatar($v)
	{


		if ($v === null) {
			$this->setIdAvatar(NULL);
		} else {
			$this->setIdAvatar($v->getId());
		}


		$this->aAvatar = $v;
	}


	
	public function getAvatar($con = null)
	{
		if ($this->aAvatar === null && ($this->id_avatar !== null)) {
						include_once 'lib/model/om/BaseAvatarPeer.php';

			$this->aAvatar = AvatarPeer::retrieveByPK($this->id_avatar, $con);

			
		}
		return $this->aAvatar;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseComment:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseComment::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 