<?php


abstract class BasesfSimpleForumTopicViewPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sf_simple_forum_topic_view';

	
	const CLASS_DEFAULT = 'plugins.sfSimpleForumPlugin.lib.model.sfSimpleForumTopicView';

	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const USER_ID = 'sf_simple_forum_topic_view.USER_ID';

	
	const TOPIC_ID = 'sf_simple_forum_topic_view.TOPIC_ID';

	
	const CREATED_AT = 'sf_simple_forum_topic_view.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('UserId', 'TopicId', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME => array (sfSimpleForumTopicViewPeer::USER_ID, sfSimpleForumTopicViewPeer::TOPIC_ID, sfSimpleForumTopicViewPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('user_id', 'topic_id', 'created_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('UserId' => 0, 'TopicId' => 1, 'CreatedAt' => 2, ),
		BasePeer::TYPE_COLNAME => array (sfSimpleForumTopicViewPeer::USER_ID => 0, sfSimpleForumTopicViewPeer::TOPIC_ID => 1, sfSimpleForumTopicViewPeer::CREATED_AT => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('user_id' => 0, 'topic_id' => 1, 'created_at' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/sfSimpleForumPlugin/lib/model/map/sfSimpleForumTopicViewMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.sfSimpleForumPlugin.lib.model.map.sfSimpleForumTopicViewMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = sfSimpleForumTopicViewPeer::getTableMap();
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
		return str_replace(sfSimpleForumTopicViewPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(sfSimpleForumTopicViewPeer::USER_ID);

		$criteria->addSelectColumn(sfSimpleForumTopicViewPeer::TOPIC_ID);

		$criteria->addSelectColumn(sfSimpleForumTopicViewPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(sf_simple_forum_topic_view.USER_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT sf_simple_forum_topic_view.USER_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumTopicViewPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumTopicViewPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = sfSimpleForumTopicViewPeer::doSelectRS($criteria, $con);
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
		$objects = sfSimpleForumTopicViewPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return sfSimpleForumTopicViewPeer::populateObjects(sfSimpleForumTopicViewPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicViewPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicViewPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			sfSimpleForumTopicViewPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = sfSimpleForumTopicViewPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinAccount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumTopicViewPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumTopicViewPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumTopicViewPeer::USER_ID, AccountPeer::ID);

		$rs = sfSimpleForumTopicViewPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinsfSimpleForumTopic(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumTopicViewPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumTopicViewPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumTopicViewPeer::TOPIC_ID, sfSimpleForumTopicPeer::ID);

		$rs = sfSimpleForumTopicViewPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAccount(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumTopicViewPeer::addSelectColumns($c);
		$startcol = (sfSimpleForumTopicViewPeer::NUM_COLUMNS - sfSimpleForumTopicViewPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AccountPeer::addSelectColumns($c);

		$c->addJoin(sfSimpleForumTopicViewPeer::USER_ID, AccountPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumTopicViewPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AccountPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getAccount(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addsfSimpleForumTopicView($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initsfSimpleForumTopicViews();
				$obj2->addsfSimpleForumTopicView($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinsfSimpleForumTopic(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumTopicViewPeer::addSelectColumns($c);
		$startcol = (sfSimpleForumTopicViewPeer::NUM_COLUMNS - sfSimpleForumTopicViewPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		sfSimpleForumTopicPeer::addSelectColumns($c);

		$c->addJoin(sfSimpleForumTopicViewPeer::TOPIC_ID, sfSimpleForumTopicPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumTopicViewPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfSimpleForumTopicPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getsfSimpleForumTopic(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addsfSimpleForumTopicView($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initsfSimpleForumTopicViews();
				$obj2->addsfSimpleForumTopicView($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumTopicViewPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumTopicViewPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumTopicViewPeer::USER_ID, AccountPeer::ID);

		$criteria->addJoin(sfSimpleForumTopicViewPeer::TOPIC_ID, sfSimpleForumTopicPeer::ID);

		$rs = sfSimpleForumTopicViewPeer::doSelectRS($criteria, $con);
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

		sfSimpleForumTopicViewPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumTopicViewPeer::NUM_COLUMNS - sfSimpleForumTopicViewPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AccountPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AccountPeer::NUM_COLUMNS;

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + sfSimpleForumTopicPeer::NUM_COLUMNS;

		$c->addJoin(sfSimpleForumTopicViewPeer::USER_ID, AccountPeer::ID);

		$c->addJoin(sfSimpleForumTopicViewPeer::TOPIC_ID, sfSimpleForumTopicPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumTopicViewPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = AccountPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAccount(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addsfSimpleForumTopicView($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initsfSimpleForumTopicViews();
				$obj2->addsfSimpleForumTopicView($obj1);
			}


					
			$omClass = sfSimpleForumTopicPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getsfSimpleForumTopic(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addsfSimpleForumTopicView($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initsfSimpleForumTopicViews();
				$obj3->addsfSimpleForumTopicView($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptAccount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumTopicViewPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumTopicViewPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumTopicViewPeer::TOPIC_ID, sfSimpleForumTopicPeer::ID);

		$rs = sfSimpleForumTopicViewPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptsfSimpleForumTopic(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumTopicViewPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumTopicViewPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumTopicViewPeer::USER_ID, AccountPeer::ID);

		$rs = sfSimpleForumTopicViewPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptAccount(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumTopicViewPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumTopicViewPeer::NUM_COLUMNS - sfSimpleForumTopicViewPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfSimpleForumTopicPeer::NUM_COLUMNS;

		$c->addJoin(sfSimpleForumTopicViewPeer::TOPIC_ID, sfSimpleForumTopicPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumTopicViewPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfSimpleForumTopicPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getsfSimpleForumTopic(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addsfSimpleForumTopicView($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initsfSimpleForumTopicViews();
				$obj2->addsfSimpleForumTopicView($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptsfSimpleForumTopic(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumTopicViewPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumTopicViewPeer::NUM_COLUMNS - sfSimpleForumTopicViewPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AccountPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AccountPeer::NUM_COLUMNS;

		$c->addJoin(sfSimpleForumTopicViewPeer::USER_ID, AccountPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumTopicViewPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AccountPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAccount(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addsfSimpleForumTopicView($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initsfSimpleForumTopicViews();
				$obj2->addsfSimpleForumTopicView($obj1);
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
		return sfSimpleForumTopicViewPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicViewPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasesfSimpleForumTopicViewPeer', $values, $con);
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


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BasesfSimpleForumTopicViewPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicViewPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicViewPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasesfSimpleForumTopicViewPeer', $values, $con);
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
			$comparison = $criteria->getComparison(sfSimpleForumTopicViewPeer::USER_ID);
			$selectCriteria->add(sfSimpleForumTopicViewPeer::USER_ID, $criteria->remove(sfSimpleForumTopicViewPeer::USER_ID), $comparison);

			$comparison = $criteria->getComparison(sfSimpleForumTopicViewPeer::TOPIC_ID);
			$selectCriteria->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $criteria->remove(sfSimpleForumTopicViewPeer::TOPIC_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicViewPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicViewPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(sfSimpleForumTopicViewPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(sfSimpleForumTopicViewPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof sfSimpleForumTopicView) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
												if(count($values) == count($values, COUNT_RECURSIVE))
			{
								$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
			}

			$criteria->add(sfSimpleForumTopicViewPeer::USER_ID, $vals[0], Criteria::IN);
			$criteria->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(sfSimpleForumTopicView $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(sfSimpleForumTopicViewPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(sfSimpleForumTopicViewPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(sfSimpleForumTopicViewPeer::DATABASE_NAME, sfSimpleForumTopicViewPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = sfSimpleForumTopicViewPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $user_id, $topic_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(sfSimpleForumTopicViewPeer::USER_ID, $user_id);
		$criteria->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $topic_id);
		$v = sfSimpleForumTopicViewPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BasesfSimpleForumTopicViewPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/sfSimpleForumPlugin/lib/model/map/sfSimpleForumTopicViewMapBuilder.php';
	Propel::registerMapBuilder('plugins.sfSimpleForumPlugin.lib.model.map.sfSimpleForumTopicViewMapBuilder');
}
