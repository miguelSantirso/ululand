<?php


abstract class BaseAvatarPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'avatar';

	
	const CLASS_DEFAULT = 'lib.model.Avatar';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'avatar.ID';

	
	const PROFILE_ID = 'avatar.PROFILE_ID';

	
	const API_KEY = 'avatar.API_KEY';

	
	const NAME = 'avatar.NAME';

	
	const GENDER = 'avatar.GENDER';

	
	const TOTAL_CREDITS = 'avatar.TOTAL_CREDITS';

	
	const SPENT_CREDITS = 'avatar.SPENT_CREDITS';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ProfileId', 'ApiKey', 'Name', 'Gender', 'TotalCredits', 'SpentCredits', ),
		BasePeer::TYPE_COLNAME => array (AvatarPeer::ID, AvatarPeer::PROFILE_ID, AvatarPeer::API_KEY, AvatarPeer::NAME, AvatarPeer::GENDER, AvatarPeer::TOTAL_CREDITS, AvatarPeer::SPENT_CREDITS, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'profile_id', 'api_key', 'name', 'gender', 'total_credits', 'spent_credits', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ProfileId' => 1, 'ApiKey' => 2, 'Name' => 3, 'Gender' => 4, 'TotalCredits' => 5, 'SpentCredits' => 6, ),
		BasePeer::TYPE_COLNAME => array (AvatarPeer::ID => 0, AvatarPeer::PROFILE_ID => 1, AvatarPeer::API_KEY => 2, AvatarPeer::NAME => 3, AvatarPeer::GENDER => 4, AvatarPeer::TOTAL_CREDITS => 5, AvatarPeer::SPENT_CREDITS => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'profile_id' => 1, 'api_key' => 2, 'name' => 3, 'gender' => 4, 'total_credits' => 5, 'spent_credits' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/AvatarMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.AvatarMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = AvatarPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(AvatarPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AvatarPeer::ID);

		$criteria->addSelectColumn(AvatarPeer::PROFILE_ID);

		$criteria->addSelectColumn(AvatarPeer::API_KEY);

		$criteria->addSelectColumn(AvatarPeer::NAME);

		$criteria->addSelectColumn(AvatarPeer::GENDER);

		$criteria->addSelectColumn(AvatarPeer::TOTAL_CREDITS);

		$criteria->addSelectColumn(AvatarPeer::SPENT_CREDITS);

	}

	const COUNT = 'COUNT(avatar.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT avatar.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AvatarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AvatarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AvatarPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = AvatarPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return AvatarPeer::populateObjects(AvatarPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatarPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseAvatarPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			AvatarPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = AvatarPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinsfGuardUserProfile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AvatarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AvatarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AvatarPeer::PROFILE_ID, sfGuardUserProfilePeer::ID);

		$rs = AvatarPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinsfGuardUserProfile(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AvatarPeer::addSelectColumns($c);
		$startcol = (AvatarPeer::NUM_COLUMNS - AvatarPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		sfGuardUserProfilePeer::addSelectColumns($c);

		$c->addJoin(AvatarPeer::PROFILE_ID, sfGuardUserProfilePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AvatarPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfGuardUserProfilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getsfGuardUserProfile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addAvatar($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initAvatars();
				$obj2->addAvatar($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AvatarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AvatarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AvatarPeer::PROFILE_ID, sfGuardUserProfilePeer::ID);

		$rs = AvatarPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AvatarPeer::addSelectColumns($c);
		$startcol2 = (AvatarPeer::NUM_COLUMNS - AvatarPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfGuardUserProfilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfGuardUserProfilePeer::NUM_COLUMNS;

		$c->addJoin(AvatarPeer::PROFILE_ID, sfGuardUserProfilePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AvatarPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = sfGuardUserProfilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getsfGuardUserProfile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addAvatar($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initAvatars();
				$obj2->addAvatar($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return AvatarPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatarPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAvatarPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(AvatarPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseAvatarPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseAvatarPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatarPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAvatarPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(AvatarPeer::ID);
			$selectCriteria->add(AvatarPeer::ID, $criteria->remove(AvatarPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseAvatarPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseAvatarPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += AvatarPeer::doOnDeleteCascade(new Criteria(), $con);
			AvatarPeer::doOnDeleteSetNull(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(AvatarPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(AvatarPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Avatar) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AvatarPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += AvatarPeer::doOnDeleteCascade($criteria, $con);AvatarPeer::doOnDeleteSetNull($criteria, $con);
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected static function doOnDeleteCascade(Criteria $criteria, Connection $con)
	{
				$affectedRows = 0;

				$objects = AvatarPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/Avatar_Group.php';

						$c = new Criteria();
			
			$c->add(Avatar_GroupPeer::AVATAR_ID, $obj->getId());
			$affectedRows += Avatar_GroupPeer::doDelete($c, $con);

			include_once 'lib/model/AvatarPiece.php';

						$c = new Criteria();
			
			$c->add(AvatarPiecePeer::OWNER_ID, $obj->getId());
			$affectedRows += AvatarPiecePeer::doDelete($c, $con);

			include_once 'lib/model/Avatar_Item.php';

						$c = new Criteria();
			
			$c->add(Avatar_ItemPeer::ID_AVATAR, $obj->getId());
			$affectedRows += Avatar_ItemPeer::doDelete($c, $con);

			include_once 'lib/model/Comment.php';

						$c = new Criteria();
			
			$c->add(CommentPeer::ID_AVATAR, $obj->getId());
			$affectedRows += CommentPeer::doDelete($c, $con);

			include_once 'lib/model/Message.php';

						$c = new Criteria();
			
			$c->add(MessagePeer::ID_SENDER, $obj->getId());
			$affectedRows += MessagePeer::doDelete($c, $con);

			include_once 'lib/model/Message.php';

						$c = new Criteria();
			
			$c->add(MessagePeer::ID_RECIPIENT, $obj->getId());
			$affectedRows += MessagePeer::doDelete($c, $con);

			include_once 'lib/model/GameStat_Avatar.php';

						$c = new Criteria();
			
			$c->add(GameStat_AvatarPeer::AVATAR_ID, $obj->getId());
			$affectedRows += GameStat_AvatarPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	protected static function doOnDeleteSetNull(Criteria $criteria, Connection $con)
	{

				$objects = AvatarPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {

						$selectCriteria = new Criteria(AvatarPeer::DATABASE_NAME);
			$updateValues = new Criteria(AvatarPeer::DATABASE_NAME);
			$selectCriteria->add(AvatarPiecePeer::AUTHOR_ID, $obj->getId());
			$updateValues->add(AvatarPiecePeer::AUTHOR_ID, null);

			BasePeer::doUpdate($selectCriteria, $updateValues, $con); 
		}
	}

	
	public static function doValidate(Avatar $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AvatarPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AvatarPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(AvatarPeer::DATABASE_NAME, AvatarPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AvatarPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(AvatarPeer::DATABASE_NAME);

		$criteria->add(AvatarPeer::ID, $pk);


		$v = AvatarPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(AvatarPeer::ID, $pks, Criteria::IN);
			$objs = AvatarPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseAvatarPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/AvatarMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.AvatarMapBuilder');
}
