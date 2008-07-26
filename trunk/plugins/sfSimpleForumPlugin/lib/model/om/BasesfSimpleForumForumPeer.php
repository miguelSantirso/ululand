<?php


abstract class BasesfSimpleForumForumPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sf_simple_forum_forum';

	
	const CLASS_DEFAULT = 'plugins.sfSimpleForumPlugin.lib.model.sfSimpleForumForum';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'sf_simple_forum_forum.ID';

	
	const NAME = 'sf_simple_forum_forum.NAME';

	
	const DESCRIPTION = 'sf_simple_forum_forum.DESCRIPTION';

	
	const RANK = 'sf_simple_forum_forum.RANK';

	
	const CATEGORY_ID = 'sf_simple_forum_forum.CATEGORY_ID';

	
	const CREATED_AT = 'sf_simple_forum_forum.CREATED_AT';

	
	const UPDATED_AT = 'sf_simple_forum_forum.UPDATED_AT';

	
	const STRIPPED_NAME = 'sf_simple_forum_forum.STRIPPED_NAME';

	
	const LATEST_POST_ID = 'sf_simple_forum_forum.LATEST_POST_ID';

	
	const NB_POSTS = 'sf_simple_forum_forum.NB_POSTS';

	
	const NB_TOPICS = 'sf_simple_forum_forum.NB_TOPICS';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'Description', 'Rank', 'CategoryId', 'CreatedAt', 'UpdatedAt', 'StrippedName', 'LatestPostId', 'NbPosts', 'NbTopics', ),
		BasePeer::TYPE_COLNAME => array (sfSimpleForumForumPeer::ID, sfSimpleForumForumPeer::NAME, sfSimpleForumForumPeer::DESCRIPTION, sfSimpleForumForumPeer::RANK, sfSimpleForumForumPeer::CATEGORY_ID, sfSimpleForumForumPeer::CREATED_AT, sfSimpleForumForumPeer::UPDATED_AT, sfSimpleForumForumPeer::STRIPPED_NAME, sfSimpleForumForumPeer::LATEST_POST_ID, sfSimpleForumForumPeer::NB_POSTS, sfSimpleForumForumPeer::NB_TOPICS, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'description', 'rank', 'category_id', 'created_at', 'updated_at', 'stripped_name', 'latest_post_id', 'nb_posts', 'nb_topics', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'Description' => 2, 'Rank' => 3, 'CategoryId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'StrippedName' => 7, 'LatestPostId' => 8, 'NbPosts' => 9, 'NbTopics' => 10, ),
		BasePeer::TYPE_COLNAME => array (sfSimpleForumForumPeer::ID => 0, sfSimpleForumForumPeer::NAME => 1, sfSimpleForumForumPeer::DESCRIPTION => 2, sfSimpleForumForumPeer::RANK => 3, sfSimpleForumForumPeer::CATEGORY_ID => 4, sfSimpleForumForumPeer::CREATED_AT => 5, sfSimpleForumForumPeer::UPDATED_AT => 6, sfSimpleForumForumPeer::STRIPPED_NAME => 7, sfSimpleForumForumPeer::LATEST_POST_ID => 8, sfSimpleForumForumPeer::NB_POSTS => 9, sfSimpleForumForumPeer::NB_TOPICS => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'description' => 2, 'rank' => 3, 'category_id' => 4, 'created_at' => 5, 'updated_at' => 6, 'stripped_name' => 7, 'latest_post_id' => 8, 'nb_posts' => 9, 'nb_topics' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/sfSimpleForumPlugin/lib/model/map/sfSimpleForumForumMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.sfSimpleForumPlugin.lib.model.map.sfSimpleForumForumMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = sfSimpleForumForumPeer::getTableMap();
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
		return str_replace(sfSimpleForumForumPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(sfSimpleForumForumPeer::ID);

		$criteria->addSelectColumn(sfSimpleForumForumPeer::NAME);

		$criteria->addSelectColumn(sfSimpleForumForumPeer::DESCRIPTION);

		$criteria->addSelectColumn(sfSimpleForumForumPeer::RANK);

		$criteria->addSelectColumn(sfSimpleForumForumPeer::CATEGORY_ID);

		$criteria->addSelectColumn(sfSimpleForumForumPeer::CREATED_AT);

		$criteria->addSelectColumn(sfSimpleForumForumPeer::UPDATED_AT);

		$criteria->addSelectColumn(sfSimpleForumForumPeer::STRIPPED_NAME);

		$criteria->addSelectColumn(sfSimpleForumForumPeer::LATEST_POST_ID);

		$criteria->addSelectColumn(sfSimpleForumForumPeer::NB_POSTS);

		$criteria->addSelectColumn(sfSimpleForumForumPeer::NB_TOPICS);

	}

	const COUNT = 'COUNT(sf_simple_forum_forum.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT sf_simple_forum_forum.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumForumPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumForumPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = sfSimpleForumForumPeer::doSelectRS($criteria, $con);
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
		$objects = sfSimpleForumForumPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return sfSimpleForumForumPeer::populateObjects(sfSimpleForumForumPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumForumPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumForumPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			sfSimpleForumForumPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = sfSimpleForumForumPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinsfSimpleForumCategory(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumForumPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumForumPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumForumPeer::CATEGORY_ID, sfSimpleForumCategoryPeer::ID);

		$rs = sfSimpleForumForumPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinsfSimpleForumPost(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumForumPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumForumPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumForumPeer::LATEST_POST_ID, sfSimpleForumPostPeer::ID);

		$rs = sfSimpleForumForumPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinsfSimpleForumCategory(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumForumPeer::addSelectColumns($c);
		$startcol = (sfSimpleForumForumPeer::NUM_COLUMNS - sfSimpleForumForumPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		sfSimpleForumCategoryPeer::addSelectColumns($c);

		$c->addJoin(sfSimpleForumForumPeer::CATEGORY_ID, sfSimpleForumCategoryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumForumPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfSimpleForumCategoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getsfSimpleForumCategory(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addsfSimpleForumForum($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initsfSimpleForumForums();
				$obj2->addsfSimpleForumForum($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinsfSimpleForumPost(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumForumPeer::addSelectColumns($c);
		$startcol = (sfSimpleForumForumPeer::NUM_COLUMNS - sfSimpleForumForumPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		sfSimpleForumPostPeer::addSelectColumns($c);

		$c->addJoin(sfSimpleForumForumPeer::LATEST_POST_ID, sfSimpleForumPostPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumForumPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfSimpleForumPostPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getsfSimpleForumPost(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addsfSimpleForumForum($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initsfSimpleForumForums();
				$obj2->addsfSimpleForumForum($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumForumPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumForumPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumForumPeer::CATEGORY_ID, sfSimpleForumCategoryPeer::ID);

		$criteria->addJoin(sfSimpleForumForumPeer::LATEST_POST_ID, sfSimpleForumPostPeer::ID);

		$rs = sfSimpleForumForumPeer::doSelectRS($criteria, $con);
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

		sfSimpleForumForumPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumForumPeer::NUM_COLUMNS - sfSimpleForumForumPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfSimpleForumCategoryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfSimpleForumCategoryPeer::NUM_COLUMNS;

		sfSimpleForumPostPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + sfSimpleForumPostPeer::NUM_COLUMNS;

		$c->addJoin(sfSimpleForumForumPeer::CATEGORY_ID, sfSimpleForumCategoryPeer::ID);

		$c->addJoin(sfSimpleForumForumPeer::LATEST_POST_ID, sfSimpleForumPostPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumForumPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = sfSimpleForumCategoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getsfSimpleForumCategory(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addsfSimpleForumForum($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initsfSimpleForumForums();
				$obj2->addsfSimpleForumForum($obj1);
			}


					
			$omClass = sfSimpleForumPostPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getsfSimpleForumPost(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addsfSimpleForumForum($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initsfSimpleForumForums();
				$obj3->addsfSimpleForumForum($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptsfSimpleForumCategory(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumForumPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumForumPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumForumPeer::LATEST_POST_ID, sfSimpleForumPostPeer::ID);

		$rs = sfSimpleForumForumPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptsfSimpleForumPost(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumForumPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumForumPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumForumPeer::CATEGORY_ID, sfSimpleForumCategoryPeer::ID);

		$rs = sfSimpleForumForumPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptsfSimpleForumCategory(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumForumPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumForumPeer::NUM_COLUMNS - sfSimpleForumForumPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfSimpleForumPostPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfSimpleForumPostPeer::NUM_COLUMNS;

		$c->addJoin(sfSimpleForumForumPeer::LATEST_POST_ID, sfSimpleForumPostPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumForumPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfSimpleForumPostPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getsfSimpleForumPost(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addsfSimpleForumForum($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initsfSimpleForumForums();
				$obj2->addsfSimpleForumForum($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptsfSimpleForumPost(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumForumPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumForumPeer::NUM_COLUMNS - sfSimpleForumForumPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfSimpleForumCategoryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfSimpleForumCategoryPeer::NUM_COLUMNS;

		$c->addJoin(sfSimpleForumForumPeer::CATEGORY_ID, sfSimpleForumCategoryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumForumPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfSimpleForumCategoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getsfSimpleForumCategory(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addsfSimpleForumForum($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initsfSimpleForumForums();
				$obj2->addsfSimpleForumForum($obj1);
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
		return sfSimpleForumForumPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumForumPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasesfSimpleForumForumPeer', $values, $con);
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

		$criteria->remove(sfSimpleForumForumPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BasesfSimpleForumForumPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumForumPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumForumPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasesfSimpleForumForumPeer', $values, $con);
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
			$comparison = $criteria->getComparison(sfSimpleForumForumPeer::ID);
			$selectCriteria->add(sfSimpleForumForumPeer::ID, $criteria->remove(sfSimpleForumForumPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasesfSimpleForumForumPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumForumPeer', $values, $con, $ret);
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
			$affectedRows += sfSimpleForumForumPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(sfSimpleForumForumPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(sfSimpleForumForumPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof sfSimpleForumForum) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(sfSimpleForumForumPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += sfSimpleForumForumPeer::doOnDeleteCascade($criteria, $con);
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

				$objects = sfSimpleForumForumPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'plugins/sfSimpleForumPlugin/lib/model/sfSimpleForumTopic.php';

						$c = new Criteria();
			
			$c->add(sfSimpleForumTopicPeer::FORUM_ID, $obj->getId());
			$affectedRows += sfSimpleForumTopicPeer::doDelete($c, $con);

			include_once 'plugins/sfSimpleForumPlugin/lib/model/sfSimpleForumPost.php';

						$c = new Criteria();
			
			$c->add(sfSimpleForumPostPeer::FORUM_ID, $obj->getId());
			$affectedRows += sfSimpleForumPostPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(sfSimpleForumForum $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(sfSimpleForumForumPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(sfSimpleForumForumPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(sfSimpleForumForumPeer::DATABASE_NAME, sfSimpleForumForumPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = sfSimpleForumForumPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);

		$criteria->add(sfSimpleForumForumPeer::ID, $pk);


		$v = sfSimpleForumForumPeer::doSelect($criteria, $con);

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
			$criteria->add(sfSimpleForumForumPeer::ID, $pks, Criteria::IN);
			$objs = sfSimpleForumForumPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasesfSimpleForumForumPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/sfSimpleForumPlugin/lib/model/map/sfSimpleForumForumMapBuilder.php';
	Propel::registerMapBuilder('plugins.sfSimpleForumPlugin.lib.model.map.sfSimpleForumForumMapBuilder');
}
