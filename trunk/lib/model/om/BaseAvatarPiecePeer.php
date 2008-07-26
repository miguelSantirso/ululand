<?php


abstract class BaseAvatarPiecePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'avatarpiece';

	
	const CLASS_DEFAULT = 'lib.model.AvatarPiece';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'avatarpiece.ID';

	
	const NAME = 'avatarpiece.NAME';

	
	const DESCRIPTION = 'avatarpiece.DESCRIPTION';

	
	const AUTHOR_ID = 'avatarpiece.AUTHOR_ID';

	
	const OWNER_ID = 'avatarpiece.OWNER_ID';

	
	const URL = 'avatarpiece.URL';

	
	const PRICE = 'avatarpiece.PRICE';

	
	const TYPE = 'avatarpiece.TYPE';

	
	const IN_USE = 'avatarpiece.IN_USE';

	
	const CREATED_AT = 'avatarpiece.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'Description', 'AuthorId', 'OwnerId', 'Url', 'Price', 'Type', 'InUse', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (AvatarPiecePeer::ID, AvatarPiecePeer::NAME, AvatarPiecePeer::DESCRIPTION, AvatarPiecePeer::AUTHOR_ID, AvatarPiecePeer::OWNER_ID, AvatarPiecePeer::URL, AvatarPiecePeer::PRICE, AvatarPiecePeer::TYPE, AvatarPiecePeer::IN_USE, AvatarPiecePeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'description', 'author_id', 'owner_id', 'url', 'price', 'type', 'in_use', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'Description' => 2, 'AuthorId' => 3, 'OwnerId' => 4, 'Url' => 5, 'Price' => 6, 'Type' => 7, 'InUse' => 8, 'CreatedAt' => 9, ),
		BasePeer::TYPE_COLNAME => array (AvatarPiecePeer::ID => 0, AvatarPiecePeer::NAME => 1, AvatarPiecePeer::DESCRIPTION => 2, AvatarPiecePeer::AUTHOR_ID => 3, AvatarPiecePeer::OWNER_ID => 4, AvatarPiecePeer::URL => 5, AvatarPiecePeer::PRICE => 6, AvatarPiecePeer::TYPE => 7, AvatarPiecePeer::IN_USE => 8, AvatarPiecePeer::CREATED_AT => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'description' => 2, 'author_id' => 3, 'owner_id' => 4, 'url' => 5, 'price' => 6, 'type' => 7, 'in_use' => 8, 'created_at' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/AvatarPieceMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.AvatarPieceMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = AvatarPiecePeer::getTableMap();
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
		return str_replace(AvatarPiecePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AvatarPiecePeer::ID);

		$criteria->addSelectColumn(AvatarPiecePeer::NAME);

		$criteria->addSelectColumn(AvatarPiecePeer::DESCRIPTION);

		$criteria->addSelectColumn(AvatarPiecePeer::AUTHOR_ID);

		$criteria->addSelectColumn(AvatarPiecePeer::OWNER_ID);

		$criteria->addSelectColumn(AvatarPiecePeer::URL);

		$criteria->addSelectColumn(AvatarPiecePeer::PRICE);

		$criteria->addSelectColumn(AvatarPiecePeer::TYPE);

		$criteria->addSelectColumn(AvatarPiecePeer::IN_USE);

		$criteria->addSelectColumn(AvatarPiecePeer::CREATED_AT);

	}

	const COUNT = 'COUNT(avatarpiece.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT avatarpiece.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AvatarPiecePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AvatarPiecePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AvatarPiecePeer::doSelectRS($criteria, $con);
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
		$objects = AvatarPiecePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return AvatarPiecePeer::populateObjects(AvatarPiecePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatarPiecePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseAvatarPiecePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			AvatarPiecePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = AvatarPiecePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinAvatarRelatedByAuthorId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AvatarPiecePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AvatarPiecePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AvatarPiecePeer::AUTHOR_ID, AvatarPeer::ID);

		$rs = AvatarPiecePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAvatarRelatedByOwnerId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AvatarPiecePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AvatarPiecePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AvatarPiecePeer::OWNER_ID, AvatarPeer::ID);

		$rs = AvatarPiecePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAvatarRelatedByAuthorId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AvatarPiecePeer::addSelectColumns($c);
		$startcol = (AvatarPiecePeer::NUM_COLUMNS - AvatarPiecePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AvatarPeer::addSelectColumns($c);

		$c->addJoin(AvatarPiecePeer::AUTHOR_ID, AvatarPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AvatarPiecePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AvatarPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getAvatarRelatedByAuthorId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addAvatarPieceRelatedByAuthorId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initAvatarPiecesRelatedByAuthorId();
				$obj2->addAvatarPieceRelatedByAuthorId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAvatarRelatedByOwnerId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AvatarPiecePeer::addSelectColumns($c);
		$startcol = (AvatarPiecePeer::NUM_COLUMNS - AvatarPiecePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AvatarPeer::addSelectColumns($c);

		$c->addJoin(AvatarPiecePeer::OWNER_ID, AvatarPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AvatarPiecePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AvatarPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getAvatarRelatedByOwnerId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addAvatarPieceRelatedByOwnerId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initAvatarPiecesRelatedByOwnerId();
				$obj2->addAvatarPieceRelatedByOwnerId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AvatarPiecePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AvatarPiecePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AvatarPiecePeer::AUTHOR_ID, AvatarPeer::ID);

		$criteria->addJoin(AvatarPiecePeer::OWNER_ID, AvatarPeer::ID);

		$rs = AvatarPiecePeer::doSelectRS($criteria, $con);
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

		AvatarPiecePeer::addSelectColumns($c);
		$startcol2 = (AvatarPiecePeer::NUM_COLUMNS - AvatarPiecePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AvatarPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AvatarPeer::NUM_COLUMNS;

		AvatarPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AvatarPeer::NUM_COLUMNS;

		$c->addJoin(AvatarPiecePeer::AUTHOR_ID, AvatarPeer::ID);

		$c->addJoin(AvatarPiecePeer::OWNER_ID, AvatarPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AvatarPiecePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = AvatarPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAvatarRelatedByAuthorId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addAvatarPieceRelatedByAuthorId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initAvatarPiecesRelatedByAuthorId();
				$obj2->addAvatarPieceRelatedByAuthorId($obj1);
			}


					
			$omClass = AvatarPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getAvatarRelatedByOwnerId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addAvatarPieceRelatedByOwnerId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initAvatarPiecesRelatedByOwnerId();
				$obj3->addAvatarPieceRelatedByOwnerId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptAvatarRelatedByAuthorId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AvatarPiecePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AvatarPiecePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AvatarPiecePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptAvatarRelatedByOwnerId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AvatarPiecePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AvatarPiecePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AvatarPiecePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptAvatarRelatedByAuthorId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AvatarPiecePeer::addSelectColumns($c);
		$startcol2 = (AvatarPiecePeer::NUM_COLUMNS - AvatarPiecePeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AvatarPiecePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptAvatarRelatedByOwnerId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AvatarPiecePeer::addSelectColumns($c);
		$startcol2 = (AvatarPiecePeer::NUM_COLUMNS - AvatarPiecePeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AvatarPiecePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

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
		return AvatarPiecePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatarPiecePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAvatarPiecePeer', $values, $con);
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

		$criteria->remove(AvatarPiecePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseAvatarPiecePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseAvatarPiecePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatarPiecePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAvatarPiecePeer', $values, $con);
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
			$comparison = $criteria->getComparison(AvatarPiecePeer::ID);
			$selectCriteria->add(AvatarPiecePeer::ID, $criteria->remove(AvatarPiecePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseAvatarPiecePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseAvatarPiecePeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(AvatarPiecePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(AvatarPiecePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof AvatarPiece) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AvatarPiecePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(AvatarPiece $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AvatarPiecePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AvatarPiecePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AvatarPiecePeer::DATABASE_NAME, AvatarPiecePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AvatarPiecePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(AvatarPiecePeer::DATABASE_NAME);

		$criteria->add(AvatarPiecePeer::ID, $pk);


		$v = AvatarPiecePeer::doSelect($criteria, $con);

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
			$criteria->add(AvatarPiecePeer::ID, $pks, Criteria::IN);
			$objs = AvatarPiecePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseAvatarPiecePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/AvatarPieceMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.AvatarPieceMapBuilder');
}
