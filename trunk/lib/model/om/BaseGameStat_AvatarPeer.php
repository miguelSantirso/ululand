<?php


abstract class BaseGameStat_AvatarPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'gamestat_avatar';

	
	const CLASS_DEFAULT = 'lib.model.GameStat_Avatar';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'gamestat_avatar.ID';

	
	const GAMESTAT_ID = 'gamestat_avatar.GAMESTAT_ID';

	
	const AVATAR_ID = 'gamestat_avatar.AVATAR_ID';

	
	const VALUE = 'gamestat_avatar.VALUE';

	
	const CREATED_AT = 'gamestat_avatar.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'GamestatId', 'AvatarId', 'Value', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (GameStat_AvatarPeer::ID, GameStat_AvatarPeer::GAMESTAT_ID, GameStat_AvatarPeer::AVATAR_ID, GameStat_AvatarPeer::VALUE, GameStat_AvatarPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'gamestat_id', 'avatar_id', 'value', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'GamestatId' => 1, 'AvatarId' => 2, 'Value' => 3, 'CreatedAt' => 4, ),
		BasePeer::TYPE_COLNAME => array (GameStat_AvatarPeer::ID => 0, GameStat_AvatarPeer::GAMESTAT_ID => 1, GameStat_AvatarPeer::AVATAR_ID => 2, GameStat_AvatarPeer::VALUE => 3, GameStat_AvatarPeer::CREATED_AT => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'gamestat_id' => 1, 'avatar_id' => 2, 'value' => 3, 'created_at' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/GameStat_AvatarMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.GameStat_AvatarMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = GameStat_AvatarPeer::getTableMap();
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
		return str_replace(GameStat_AvatarPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(GameStat_AvatarPeer::ID);

		$criteria->addSelectColumn(GameStat_AvatarPeer::GAMESTAT_ID);

		$criteria->addSelectColumn(GameStat_AvatarPeer::AVATAR_ID);

		$criteria->addSelectColumn(GameStat_AvatarPeer::VALUE);

		$criteria->addSelectColumn(GameStat_AvatarPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(gamestat_avatar.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT gamestat_avatar.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(GameStat_AvatarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(GameStat_AvatarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = GameStat_AvatarPeer::doSelectRS($criteria, $con);
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
		$objects = GameStat_AvatarPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return GameStat_AvatarPeer::populateObjects(GameStat_AvatarPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseGameStat_AvatarPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseGameStat_AvatarPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			GameStat_AvatarPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = GameStat_AvatarPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinGameStat(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(GameStat_AvatarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(GameStat_AvatarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(GameStat_AvatarPeer::GAMESTAT_ID, GameStatPeer::ID);

		$rs = GameStat_AvatarPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAvatar(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(GameStat_AvatarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(GameStat_AvatarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(GameStat_AvatarPeer::AVATAR_ID, AvatarPeer::ID);

		$rs = GameStat_AvatarPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinGameStat(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GameStat_AvatarPeer::addSelectColumns($c);
		$startcol = (GameStat_AvatarPeer::NUM_COLUMNS - GameStat_AvatarPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		GameStatPeer::addSelectColumns($c);

		$c->addJoin(GameStat_AvatarPeer::GAMESTAT_ID, GameStatPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = GameStat_AvatarPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = GameStatPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getGameStat(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addGameStat_Avatar($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initGameStat_Avatars();
				$obj2->addGameStat_Avatar($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAvatar(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GameStat_AvatarPeer::addSelectColumns($c);
		$startcol = (GameStat_AvatarPeer::NUM_COLUMNS - GameStat_AvatarPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AvatarPeer::addSelectColumns($c);

		$c->addJoin(GameStat_AvatarPeer::AVATAR_ID, AvatarPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = GameStat_AvatarPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AvatarPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getAvatar(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addGameStat_Avatar($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initGameStat_Avatars();
				$obj2->addGameStat_Avatar($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(GameStat_AvatarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(GameStat_AvatarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(GameStat_AvatarPeer::GAMESTAT_ID, GameStatPeer::ID);

		$criteria->addJoin(GameStat_AvatarPeer::AVATAR_ID, AvatarPeer::ID);

		$rs = GameStat_AvatarPeer::doSelectRS($criteria, $con);
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

		GameStat_AvatarPeer::addSelectColumns($c);
		$startcol2 = (GameStat_AvatarPeer::NUM_COLUMNS - GameStat_AvatarPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		GameStatPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + GameStatPeer::NUM_COLUMNS;

		AvatarPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AvatarPeer::NUM_COLUMNS;

		$c->addJoin(GameStat_AvatarPeer::GAMESTAT_ID, GameStatPeer::ID);

		$c->addJoin(GameStat_AvatarPeer::AVATAR_ID, AvatarPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = GameStat_AvatarPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = GameStatPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getGameStat(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addGameStat_Avatar($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initGameStat_Avatars();
				$obj2->addGameStat_Avatar($obj1);
			}


					
			$omClass = AvatarPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getAvatar(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addGameStat_Avatar($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initGameStat_Avatars();
				$obj3->addGameStat_Avatar($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptGameStat(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(GameStat_AvatarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(GameStat_AvatarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(GameStat_AvatarPeer::AVATAR_ID, AvatarPeer::ID);

		$rs = GameStat_AvatarPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptAvatar(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(GameStat_AvatarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(GameStat_AvatarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(GameStat_AvatarPeer::GAMESTAT_ID, GameStatPeer::ID);

		$rs = GameStat_AvatarPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptGameStat(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GameStat_AvatarPeer::addSelectColumns($c);
		$startcol2 = (GameStat_AvatarPeer::NUM_COLUMNS - GameStat_AvatarPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AvatarPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AvatarPeer::NUM_COLUMNS;

		$c->addJoin(GameStat_AvatarPeer::AVATAR_ID, AvatarPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = GameStat_AvatarPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AvatarPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAvatar(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addGameStat_Avatar($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initGameStat_Avatars();
				$obj2->addGameStat_Avatar($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptAvatar(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		GameStat_AvatarPeer::addSelectColumns($c);
		$startcol2 = (GameStat_AvatarPeer::NUM_COLUMNS - GameStat_AvatarPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		GameStatPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + GameStatPeer::NUM_COLUMNS;

		$c->addJoin(GameStat_AvatarPeer::GAMESTAT_ID, GameStatPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = GameStat_AvatarPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = GameStatPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getGameStat(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addGameStat_Avatar($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initGameStat_Avatars();
				$obj2->addGameStat_Avatar($obj1);
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
		return GameStat_AvatarPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseGameStat_AvatarPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseGameStat_AvatarPeer', $values, $con);
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

		$criteria->remove(GameStat_AvatarPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseGameStat_AvatarPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseGameStat_AvatarPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseGameStat_AvatarPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseGameStat_AvatarPeer', $values, $con);
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
			$comparison = $criteria->getComparison(GameStat_AvatarPeer::ID);
			$selectCriteria->add(GameStat_AvatarPeer::ID, $criteria->remove(GameStat_AvatarPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseGameStat_AvatarPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseGameStat_AvatarPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(GameStat_AvatarPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(GameStat_AvatarPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof GameStat_Avatar) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(GameStat_AvatarPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(GameStat_Avatar $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(GameStat_AvatarPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(GameStat_AvatarPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(GameStat_AvatarPeer::DATABASE_NAME, GameStat_AvatarPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = GameStat_AvatarPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(GameStat_AvatarPeer::DATABASE_NAME);

		$criteria->add(GameStat_AvatarPeer::ID, $pk);


		$v = GameStat_AvatarPeer::doSelect($criteria, $con);

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
			$criteria->add(GameStat_AvatarPeer::ID, $pks, Criteria::IN);
			$objs = GameStat_AvatarPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseGameStat_AvatarPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/GameStat_AvatarMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.GameStat_AvatarMapBuilder');
}
