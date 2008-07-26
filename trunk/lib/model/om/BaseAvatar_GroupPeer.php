<?php


abstract class BaseAvatar_GroupPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'avatar_grupo';

	
	const CLASS_DEFAULT = 'lib.model.Avatar_Group';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'avatar_grupo.ID';

	
	const AVATAR_ID = 'avatar_grupo.AVATAR_ID';

	
	const GRUPO_ID = 'avatar_grupo.GRUPO_ID';

	
	const IS_OWNER = 'avatar_grupo.IS_OWNER';

	
	const IS_APPROVED = 'avatar_grupo.IS_APPROVED';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'AvatarId', 'GrupoId', 'IsOwner', 'IsApproved', ),
		BasePeer::TYPE_COLNAME => array (Avatar_GroupPeer::ID, Avatar_GroupPeer::AVATAR_ID, Avatar_GroupPeer::GRUPO_ID, Avatar_GroupPeer::IS_OWNER, Avatar_GroupPeer::IS_APPROVED, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'avatar_id', 'grupo_id', 'is_owner', 'is_approved', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'AvatarId' => 1, 'GrupoId' => 2, 'IsOwner' => 3, 'IsApproved' => 4, ),
		BasePeer::TYPE_COLNAME => array (Avatar_GroupPeer::ID => 0, Avatar_GroupPeer::AVATAR_ID => 1, Avatar_GroupPeer::GRUPO_ID => 2, Avatar_GroupPeer::IS_OWNER => 3, Avatar_GroupPeer::IS_APPROVED => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'avatar_id' => 1, 'grupo_id' => 2, 'is_owner' => 3, 'is_approved' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/Avatar_GroupMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.Avatar_GroupMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = Avatar_GroupPeer::getTableMap();
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
		return str_replace(Avatar_GroupPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(Avatar_GroupPeer::ID);

		$criteria->addSelectColumn(Avatar_GroupPeer::AVATAR_ID);

		$criteria->addSelectColumn(Avatar_GroupPeer::GRUPO_ID);

		$criteria->addSelectColumn(Avatar_GroupPeer::IS_OWNER);

		$criteria->addSelectColumn(Avatar_GroupPeer::IS_APPROVED);

	}

	const COUNT = 'COUNT(avatar_grupo.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT avatar_grupo.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Avatar_GroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Avatar_GroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = Avatar_GroupPeer::doSelectRS($criteria, $con);
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
		$objects = Avatar_GroupPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return Avatar_GroupPeer::populateObjects(Avatar_GroupPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatar_GroupPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseAvatar_GroupPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			Avatar_GroupPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = Avatar_GroupPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinAvatar(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Avatar_GroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Avatar_GroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Avatar_GroupPeer::AVATAR_ID, AvatarPeer::ID);

		$rs = Avatar_GroupPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinGroup(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Avatar_GroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Avatar_GroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Avatar_GroupPeer::GRUPO_ID, GroupPeer::ID);

		$rs = Avatar_GroupPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAvatar(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Avatar_GroupPeer::addSelectColumns($c);
		$startcol = (Avatar_GroupPeer::NUM_COLUMNS - Avatar_GroupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AvatarPeer::addSelectColumns($c);

		$c->addJoin(Avatar_GroupPeer::AVATAR_ID, AvatarPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Avatar_GroupPeer::getOMClass();

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
										$temp_obj2->addAvatar_Group($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initAvatar_Groups();
				$obj2->addAvatar_Group($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinGroup(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Avatar_GroupPeer::addSelectColumns($c);
		$startcol = (Avatar_GroupPeer::NUM_COLUMNS - Avatar_GroupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		GroupPeer::addSelectColumns($c);

		$c->addJoin(Avatar_GroupPeer::GRUPO_ID, GroupPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Avatar_GroupPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = GroupPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getGroup(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addAvatar_Group($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initAvatar_Groups();
				$obj2->addAvatar_Group($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Avatar_GroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Avatar_GroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Avatar_GroupPeer::AVATAR_ID, AvatarPeer::ID);

		$criteria->addJoin(Avatar_GroupPeer::GRUPO_ID, GroupPeer::ID);

		$rs = Avatar_GroupPeer::doSelectRS($criteria, $con);
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

		Avatar_GroupPeer::addSelectColumns($c);
		$startcol2 = (Avatar_GroupPeer::NUM_COLUMNS - Avatar_GroupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AvatarPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AvatarPeer::NUM_COLUMNS;

		GroupPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + GroupPeer::NUM_COLUMNS;

		$c->addJoin(Avatar_GroupPeer::AVATAR_ID, AvatarPeer::ID);

		$c->addJoin(Avatar_GroupPeer::GRUPO_ID, GroupPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Avatar_GroupPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getAvatar(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addAvatar_Group($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initAvatar_Groups();
				$obj2->addAvatar_Group($obj1);
			}


					
			$omClass = GroupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getGroup(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addAvatar_Group($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initAvatar_Groups();
				$obj3->addAvatar_Group($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptAvatar(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Avatar_GroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Avatar_GroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Avatar_GroupPeer::GRUPO_ID, GroupPeer::ID);

		$rs = Avatar_GroupPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptGroup(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(Avatar_GroupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(Avatar_GroupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(Avatar_GroupPeer::AVATAR_ID, AvatarPeer::ID);

		$rs = Avatar_GroupPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptAvatar(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Avatar_GroupPeer::addSelectColumns($c);
		$startcol2 = (Avatar_GroupPeer::NUM_COLUMNS - Avatar_GroupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		GroupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + GroupPeer::NUM_COLUMNS;

		$c->addJoin(Avatar_GroupPeer::GRUPO_ID, GroupPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Avatar_GroupPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = GroupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getGroup(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addAvatar_Group($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initAvatar_Groups();
				$obj2->addAvatar_Group($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptGroup(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		Avatar_GroupPeer::addSelectColumns($c);
		$startcol2 = (Avatar_GroupPeer::NUM_COLUMNS - Avatar_GroupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AvatarPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AvatarPeer::NUM_COLUMNS;

		$c->addJoin(Avatar_GroupPeer::AVATAR_ID, AvatarPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = Avatar_GroupPeer::getOMClass();

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
					$temp_obj2->addAvatar_Group($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initAvatar_Groups();
				$obj2->addAvatar_Group($obj1);
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
		return Avatar_GroupPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatar_GroupPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAvatar_GroupPeer', $values, $con);
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

		$criteria->remove(Avatar_GroupPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseAvatar_GroupPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseAvatar_GroupPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseAvatar_GroupPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAvatar_GroupPeer', $values, $con);
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
			$comparison = $criteria->getComparison(Avatar_GroupPeer::ID);
			$selectCriteria->add(Avatar_GroupPeer::ID, $criteria->remove(Avatar_GroupPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseAvatar_GroupPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseAvatar_GroupPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(Avatar_GroupPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(Avatar_GroupPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Avatar_Group) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(Avatar_GroupPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Avatar_Group $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(Avatar_GroupPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(Avatar_GroupPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(Avatar_GroupPeer::DATABASE_NAME, Avatar_GroupPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = Avatar_GroupPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(Avatar_GroupPeer::DATABASE_NAME);

		$criteria->add(Avatar_GroupPeer::ID, $pk);


		$v = Avatar_GroupPeer::doSelect($criteria, $con);

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
			$criteria->add(Avatar_GroupPeer::ID, $pks, Criteria::IN);
			$objs = Avatar_GroupPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseAvatar_GroupPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/Avatar_GroupMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.Avatar_GroupMapBuilder');
}
