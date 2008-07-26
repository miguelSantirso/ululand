<?php


abstract class BasesfSimpleForumTopicPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sf_simple_forum_topic';

	
	const CLASS_DEFAULT = 'plugins.sfSimpleForumPlugin.lib.model.sfSimpleForumTopic';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'sf_simple_forum_topic.ID';

	
	const TITLE = 'sf_simple_forum_topic.TITLE';

	
	const IS_STICKED = 'sf_simple_forum_topic.IS_STICKED';

	
	const IS_LOCKED = 'sf_simple_forum_topic.IS_LOCKED';

	
	const FORUM_ID = 'sf_simple_forum_topic.FORUM_ID';

	
	const CREATED_AT = 'sf_simple_forum_topic.CREATED_AT';

	
	const UPDATED_AT = 'sf_simple_forum_topic.UPDATED_AT';

	
	const LATEST_POST_ID = 'sf_simple_forum_topic.LATEST_POST_ID';

	
	const USER_ID = 'sf_simple_forum_topic.USER_ID';

	
	const STRIPPED_TITLE = 'sf_simple_forum_topic.STRIPPED_TITLE';

	
	const NB_POSTS = 'sf_simple_forum_topic.NB_POSTS';

	
	const NB_VIEWS = 'sf_simple_forum_topic.NB_VIEWS';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Title', 'IsSticked', 'IsLocked', 'ForumId', 'CreatedAt', 'UpdatedAt', 'LatestPostId', 'UserId', 'StrippedTitle', 'NbPosts', 'NbViews', ),
		BasePeer::TYPE_COLNAME => array (sfSimpleForumTopicPeer::ID, sfSimpleForumTopicPeer::TITLE, sfSimpleForumTopicPeer::IS_STICKED, sfSimpleForumTopicPeer::IS_LOCKED, sfSimpleForumTopicPeer::FORUM_ID, sfSimpleForumTopicPeer::CREATED_AT, sfSimpleForumTopicPeer::UPDATED_AT, sfSimpleForumTopicPeer::LATEST_POST_ID, sfSimpleForumTopicPeer::USER_ID, sfSimpleForumTopicPeer::STRIPPED_TITLE, sfSimpleForumTopicPeer::NB_POSTS, sfSimpleForumTopicPeer::NB_VIEWS, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'title', 'is_sticked', 'is_locked', 'forum_id', 'created_at', 'updated_at', 'latest_post_id', 'user_id', 'stripped_title', 'nb_posts', 'nb_views', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Title' => 1, 'IsSticked' => 2, 'IsLocked' => 3, 'ForumId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'LatestPostId' => 7, 'UserId' => 8, 'StrippedTitle' => 9, 'NbPosts' => 10, 'NbViews' => 11, ),
		BasePeer::TYPE_COLNAME => array (sfSimpleForumTopicPeer::ID => 0, sfSimpleForumTopicPeer::TITLE => 1, sfSimpleForumTopicPeer::IS_STICKED => 2, sfSimpleForumTopicPeer::IS_LOCKED => 3, sfSimpleForumTopicPeer::FORUM_ID => 4, sfSimpleForumTopicPeer::CREATED_AT => 5, sfSimpleForumTopicPeer::UPDATED_AT => 6, sfSimpleForumTopicPeer::LATEST_POST_ID => 7, sfSimpleForumTopicPeer::USER_ID => 8, sfSimpleForumTopicPeer::STRIPPED_TITLE => 9, sfSimpleForumTopicPeer::NB_POSTS => 10, sfSimpleForumTopicPeer::NB_VIEWS => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'title' => 1, 'is_sticked' => 2, 'is_locked' => 3, 'forum_id' => 4, 'created_at' => 5, 'updated_at' => 6, 'latest_post_id' => 7, 'user_id' => 8, 'stripped_title' => 9, 'nb_posts' => 10, 'nb_views' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/sfSimpleForumPlugin/lib/model/map/sfSimpleForumTopicMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.sfSimpleForumPlugin.lib.model.map.sfSimpleForumTopicMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = sfSimpleForumTopicPeer::getTableMap();
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
		return str_replace(sfSimpleForumTopicPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::ID);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::TITLE);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::IS_STICKED);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::IS_LOCKED);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::FORUM_ID);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::CREATED_AT);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::UPDATED_AT);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::LATEST_POST_ID);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::USER_ID);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::STRIPPED_TITLE);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::NB_POSTS);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::NB_VIEWS);

	}

	const COUNT = 'COUNT(sf_simple_forum_topic.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT sf_simple_forum_topic.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = sfSimpleForumTopicPeer::doSelectRS($criteria, $con);
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
		$objects = sfSimpleForumTopicPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return sfSimpleForumTopicPeer::populateObjects(sfSimpleForumTopicPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			sfSimpleForumTopicPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = sfSimpleForumTopicPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinsfSimpleForumForum(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumTopicPeer::FORUM_ID, sfSimpleForumForumPeer::ID);

		$rs = sfSimpleForumTopicPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumTopicPeer::LATEST_POST_ID, sfSimpleForumPostPeer::ID);

		$rs = sfSimpleForumTopicPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAccount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumTopicPeer::USER_ID, AccountPeer::ID);

		$rs = sfSimpleForumTopicPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinsfSimpleForumForum(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol = (sfSimpleForumTopicPeer::NUM_COLUMNS - sfSimpleForumTopicPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		sfSimpleForumForumPeer::addSelectColumns($c);

		$c->addJoin(sfSimpleForumTopicPeer::FORUM_ID, sfSimpleForumForumPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumTopicPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfSimpleForumForumPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getsfSimpleForumForum(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addsfSimpleForumTopic($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initsfSimpleForumTopics();
				$obj2->addsfSimpleForumTopic($obj1); 			}
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

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol = (sfSimpleForumTopicPeer::NUM_COLUMNS - sfSimpleForumTopicPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		sfSimpleForumPostPeer::addSelectColumns($c);

		$c->addJoin(sfSimpleForumTopicPeer::LATEST_POST_ID, sfSimpleForumPostPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumTopicPeer::getOMClass();

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
										$temp_obj2->addsfSimpleForumTopic($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initsfSimpleForumTopics();
				$obj2->addsfSimpleForumTopic($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAccount(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol = (sfSimpleForumTopicPeer::NUM_COLUMNS - sfSimpleForumTopicPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AccountPeer::addSelectColumns($c);

		$c->addJoin(sfSimpleForumTopicPeer::USER_ID, AccountPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumTopicPeer::getOMClass();

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
										$temp_obj2->addsfSimpleForumTopic($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initsfSimpleForumTopics();
				$obj2->addsfSimpleForumTopic($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumTopicPeer::FORUM_ID, sfSimpleForumForumPeer::ID);

		$criteria->addJoin(sfSimpleForumTopicPeer::LATEST_POST_ID, sfSimpleForumPostPeer::ID);

		$criteria->addJoin(sfSimpleForumTopicPeer::USER_ID, AccountPeer::ID);

		$rs = sfSimpleForumTopicPeer::doSelectRS($criteria, $con);
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

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumTopicPeer::NUM_COLUMNS - sfSimpleForumTopicPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfSimpleForumForumPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfSimpleForumForumPeer::NUM_COLUMNS;

		sfSimpleForumPostPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + sfSimpleForumPostPeer::NUM_COLUMNS;

		AccountPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + AccountPeer::NUM_COLUMNS;

		$c->addJoin(sfSimpleForumTopicPeer::FORUM_ID, sfSimpleForumForumPeer::ID);

		$c->addJoin(sfSimpleForumTopicPeer::LATEST_POST_ID, sfSimpleForumPostPeer::ID);

		$c->addJoin(sfSimpleForumTopicPeer::USER_ID, AccountPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumTopicPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = sfSimpleForumForumPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getsfSimpleForumForum(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addsfSimpleForumTopic($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initsfSimpleForumTopics();
				$obj2->addsfSimpleForumTopic($obj1);
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
					$temp_obj3->addsfSimpleForumTopic($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initsfSimpleForumTopics();
				$obj3->addsfSimpleForumTopic($obj1);
			}


					
			$omClass = AccountPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getAccount(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addsfSimpleForumTopic($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initsfSimpleForumTopics();
				$obj4->addsfSimpleForumTopic($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptsfSimpleForumForum(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumTopicPeer::LATEST_POST_ID, sfSimpleForumPostPeer::ID);

		$criteria->addJoin(sfSimpleForumTopicPeer::USER_ID, AccountPeer::ID);

		$rs = sfSimpleForumTopicPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumTopicPeer::FORUM_ID, sfSimpleForumForumPeer::ID);

		$criteria->addJoin(sfSimpleForumTopicPeer::USER_ID, AccountPeer::ID);

		$rs = sfSimpleForumTopicPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptAccount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumTopicPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumTopicPeer::FORUM_ID, sfSimpleForumForumPeer::ID);

		$criteria->addJoin(sfSimpleForumTopicPeer::LATEST_POST_ID, sfSimpleForumPostPeer::ID);

		$rs = sfSimpleForumTopicPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptsfSimpleForumForum(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumTopicPeer::NUM_COLUMNS - sfSimpleForumTopicPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfSimpleForumPostPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfSimpleForumPostPeer::NUM_COLUMNS;

		AccountPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AccountPeer::NUM_COLUMNS;

		$c->addJoin(sfSimpleForumTopicPeer::LATEST_POST_ID, sfSimpleForumPostPeer::ID);

		$c->addJoin(sfSimpleForumTopicPeer::USER_ID, AccountPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumTopicPeer::getOMClass();

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
					$temp_obj2->addsfSimpleForumTopic($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initsfSimpleForumTopics();
				$obj2->addsfSimpleForumTopic($obj1);
			}

			$omClass = AccountPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getAccount(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addsfSimpleForumTopic($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initsfSimpleForumTopics();
				$obj3->addsfSimpleForumTopic($obj1);
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

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumTopicPeer::NUM_COLUMNS - sfSimpleForumTopicPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfSimpleForumForumPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfSimpleForumForumPeer::NUM_COLUMNS;

		AccountPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AccountPeer::NUM_COLUMNS;

		$c->addJoin(sfSimpleForumTopicPeer::FORUM_ID, sfSimpleForumForumPeer::ID);

		$c->addJoin(sfSimpleForumTopicPeer::USER_ID, AccountPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumTopicPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfSimpleForumForumPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getsfSimpleForumForum(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addsfSimpleForumTopic($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initsfSimpleForumTopics();
				$obj2->addsfSimpleForumTopic($obj1);
			}

			$omClass = AccountPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getAccount(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addsfSimpleForumTopic($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initsfSimpleForumTopics();
				$obj3->addsfSimpleForumTopic($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptAccount(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumTopicPeer::NUM_COLUMNS - sfSimpleForumTopicPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfSimpleForumForumPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfSimpleForumForumPeer::NUM_COLUMNS;

		sfSimpleForumPostPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + sfSimpleForumPostPeer::NUM_COLUMNS;

		$c->addJoin(sfSimpleForumTopicPeer::FORUM_ID, sfSimpleForumForumPeer::ID);

		$c->addJoin(sfSimpleForumTopicPeer::LATEST_POST_ID, sfSimpleForumPostPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumTopicPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfSimpleForumForumPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getsfSimpleForumForum(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addsfSimpleForumTopic($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initsfSimpleForumTopics();
				$obj2->addsfSimpleForumTopic($obj1);
			}

			$omClass = sfSimpleForumPostPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getsfSimpleForumPost(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addsfSimpleForumTopic($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initsfSimpleForumTopics();
				$obj3->addsfSimpleForumTopic($obj1);
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
		return sfSimpleForumTopicPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasesfSimpleForumTopicPeer', $values, $con);
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

		$criteria->remove(sfSimpleForumTopicPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasesfSimpleForumTopicPeer', $values, $con);
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
			$comparison = $criteria->getComparison(sfSimpleForumTopicPeer::ID);
			$selectCriteria->add(sfSimpleForumTopicPeer::ID, $criteria->remove(sfSimpleForumTopicPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $values, $con, $ret);
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
			$affectedRows += sfSimpleForumTopicPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(sfSimpleForumTopicPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof sfSimpleForumTopic) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(sfSimpleForumTopicPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += sfSimpleForumTopicPeer::doOnDeleteCascade($criteria, $con);
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

				$objects = sfSimpleForumTopicPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'plugins/sfSimpleForumPlugin/lib/model/sfSimpleForumPost.php';

						$c = new Criteria();
			
			$c->add(sfSimpleForumPostPeer::TOPIC_ID, $obj->getId());
			$affectedRows += sfSimpleForumPostPeer::doDelete($c, $con);

			include_once 'plugins/sfSimpleForumPlugin/lib/model/sfSimpleForumTopicView.php';

						$c = new Criteria();
			
			$c->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $obj->getId());
			$affectedRows += sfSimpleForumTopicViewPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(sfSimpleForumTopic $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(sfSimpleForumTopicPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(sfSimpleForumTopicPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(sfSimpleForumTopicPeer::DATABASE_NAME, sfSimpleForumTopicPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = sfSimpleForumTopicPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME);

		$criteria->add(sfSimpleForumTopicPeer::ID, $pk);


		$v = sfSimpleForumTopicPeer::doSelect($criteria, $con);

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
			$criteria->add(sfSimpleForumTopicPeer::ID, $pks, Criteria::IN);
			$objs = sfSimpleForumTopicPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasesfSimpleForumTopicPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/sfSimpleForumPlugin/lib/model/map/sfSimpleForumTopicMapBuilder.php';
	Propel::registerMapBuilder('plugins.sfSimpleForumPlugin.lib.model.map.sfSimpleForumTopicMapBuilder');
}
