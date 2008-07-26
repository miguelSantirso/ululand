<?php


abstract class BasesfSimpleForumPostPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sf_simple_forum_post';

	
	const CLASS_DEFAULT = 'plugins.sfSimpleForumPlugin.lib.model.sfSimpleForumPost';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'sf_simple_forum_post.ID';

	
	const TITLE = 'sf_simple_forum_post.TITLE';

	
	const CONTENT = 'sf_simple_forum_post.CONTENT';

	
	const TOPIC_ID = 'sf_simple_forum_post.TOPIC_ID';

	
	const USER_ID = 'sf_simple_forum_post.USER_ID';

	
	const CREATED_AT = 'sf_simple_forum_post.CREATED_AT';

	
	const FORUM_ID = 'sf_simple_forum_post.FORUM_ID';

	
	const AUTHOR_NAME = 'sf_simple_forum_post.AUTHOR_NAME';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Title', 'Content', 'TopicId', 'UserId', 'CreatedAt', 'ForumId', 'AuthorName', ),
		BasePeer::TYPE_COLNAME => array (sfSimpleForumPostPeer::ID, sfSimpleForumPostPeer::TITLE, sfSimpleForumPostPeer::CONTENT, sfSimpleForumPostPeer::TOPIC_ID, sfSimpleForumPostPeer::USER_ID, sfSimpleForumPostPeer::CREATED_AT, sfSimpleForumPostPeer::FORUM_ID, sfSimpleForumPostPeer::AUTHOR_NAME, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'title', 'content', 'topic_id', 'user_id', 'created_at', 'forum_id', 'author_name', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Title' => 1, 'Content' => 2, 'TopicId' => 3, 'UserId' => 4, 'CreatedAt' => 5, 'ForumId' => 6, 'AuthorName' => 7, ),
		BasePeer::TYPE_COLNAME => array (sfSimpleForumPostPeer::ID => 0, sfSimpleForumPostPeer::TITLE => 1, sfSimpleForumPostPeer::CONTENT => 2, sfSimpleForumPostPeer::TOPIC_ID => 3, sfSimpleForumPostPeer::USER_ID => 4, sfSimpleForumPostPeer::CREATED_AT => 5, sfSimpleForumPostPeer::FORUM_ID => 6, sfSimpleForumPostPeer::AUTHOR_NAME => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'title' => 1, 'content' => 2, 'topic_id' => 3, 'user_id' => 4, 'created_at' => 5, 'forum_id' => 6, 'author_name' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/sfSimpleForumPlugin/lib/model/map/sfSimpleForumPostMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.sfSimpleForumPlugin.lib.model.map.sfSimpleForumPostMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = sfSimpleForumPostPeer::getTableMap();
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
		return str_replace(sfSimpleForumPostPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(sfSimpleForumPostPeer::ID);

		$criteria->addSelectColumn(sfSimpleForumPostPeer::TITLE);

		$criteria->addSelectColumn(sfSimpleForumPostPeer::CONTENT);

		$criteria->addSelectColumn(sfSimpleForumPostPeer::TOPIC_ID);

		$criteria->addSelectColumn(sfSimpleForumPostPeer::USER_ID);

		$criteria->addSelectColumn(sfSimpleForumPostPeer::CREATED_AT);

		$criteria->addSelectColumn(sfSimpleForumPostPeer::FORUM_ID);

		$criteria->addSelectColumn(sfSimpleForumPostPeer::AUTHOR_NAME);

	}

	const COUNT = 'COUNT(sf_simple_forum_post.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT sf_simple_forum_post.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = sfSimpleForumPostPeer::doSelectRS($criteria, $con);
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
		$objects = sfSimpleForumPostPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return sfSimpleForumPostPeer::populateObjects(sfSimpleForumPostPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumPostPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumPostPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			sfSimpleForumPostPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = sfSimpleForumPostPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinsfSimpleForumTopic(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumPostPeer::TOPIC_ID, sfSimpleForumTopicPeer::ID);

		$rs = sfSimpleForumPostPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumPostPeer::USER_ID, AccountPeer::ID);

		$rs = sfSimpleForumPostPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinsfSimpleForumForum(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumPostPeer::FORUM_ID, sfSimpleForumForumPeer::ID);

		$rs = sfSimpleForumPostPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinsfSimpleForumTopic(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumPostPeer::addSelectColumns($c);
		$startcol = (sfSimpleForumPostPeer::NUM_COLUMNS - sfSimpleForumPostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		sfSimpleForumTopicPeer::addSelectColumns($c);

		$c->addJoin(sfSimpleForumPostPeer::TOPIC_ID, sfSimpleForumTopicPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumPostPeer::getOMClass();

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
										$temp_obj2->addsfSimpleForumPost($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initsfSimpleForumPosts();
				$obj2->addsfSimpleForumPost($obj1); 			}
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

		sfSimpleForumPostPeer::addSelectColumns($c);
		$startcol = (sfSimpleForumPostPeer::NUM_COLUMNS - sfSimpleForumPostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AccountPeer::addSelectColumns($c);

		$c->addJoin(sfSimpleForumPostPeer::USER_ID, AccountPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumPostPeer::getOMClass();

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
										$temp_obj2->addsfSimpleForumPost($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initsfSimpleForumPosts();
				$obj2->addsfSimpleForumPost($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinsfSimpleForumForum(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumPostPeer::addSelectColumns($c);
		$startcol = (sfSimpleForumPostPeer::NUM_COLUMNS - sfSimpleForumPostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		sfSimpleForumForumPeer::addSelectColumns($c);

		$c->addJoin(sfSimpleForumPostPeer::FORUM_ID, sfSimpleForumForumPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumPostPeer::getOMClass();

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
										$temp_obj2->addsfSimpleForumPost($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initsfSimpleForumPosts();
				$obj2->addsfSimpleForumPost($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumPostPeer::TOPIC_ID, sfSimpleForumTopicPeer::ID);

		$criteria->addJoin(sfSimpleForumPostPeer::USER_ID, AccountPeer::ID);

		$criteria->addJoin(sfSimpleForumPostPeer::FORUM_ID, sfSimpleForumForumPeer::ID);

		$rs = sfSimpleForumPostPeer::doSelectRS($criteria, $con);
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

		sfSimpleForumPostPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumPostPeer::NUM_COLUMNS - sfSimpleForumPostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfSimpleForumTopicPeer::NUM_COLUMNS;

		AccountPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AccountPeer::NUM_COLUMNS;

		sfSimpleForumForumPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + sfSimpleForumForumPeer::NUM_COLUMNS;

		$c->addJoin(sfSimpleForumPostPeer::TOPIC_ID, sfSimpleForumTopicPeer::ID);

		$c->addJoin(sfSimpleForumPostPeer::USER_ID, AccountPeer::ID);

		$c->addJoin(sfSimpleForumPostPeer::FORUM_ID, sfSimpleForumForumPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumPostPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = sfSimpleForumTopicPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getsfSimpleForumTopic(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addsfSimpleForumPost($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initsfSimpleForumPosts();
				$obj2->addsfSimpleForumPost($obj1);
			}


					
			$omClass = AccountPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getAccount(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addsfSimpleForumPost($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initsfSimpleForumPosts();
				$obj3->addsfSimpleForumPost($obj1);
			}


					
			$omClass = sfSimpleForumForumPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getsfSimpleForumForum(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addsfSimpleForumPost($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initsfSimpleForumPosts();
				$obj4->addsfSimpleForumPost($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptsfSimpleForumTopic(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumPostPeer::USER_ID, AccountPeer::ID);

		$criteria->addJoin(sfSimpleForumPostPeer::FORUM_ID, sfSimpleForumForumPeer::ID);

		$rs = sfSimpleForumPostPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumPostPeer::TOPIC_ID, sfSimpleForumTopicPeer::ID);

		$criteria->addJoin(sfSimpleForumPostPeer::FORUM_ID, sfSimpleForumForumPeer::ID);

		$rs = sfSimpleForumPostPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptsfSimpleForumForum(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfSimpleForumPostPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfSimpleForumPostPeer::TOPIC_ID, sfSimpleForumTopicPeer::ID);

		$criteria->addJoin(sfSimpleForumPostPeer::USER_ID, AccountPeer::ID);

		$rs = sfSimpleForumPostPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptsfSimpleForumTopic(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumPostPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumPostPeer::NUM_COLUMNS - sfSimpleForumPostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AccountPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AccountPeer::NUM_COLUMNS;

		sfSimpleForumForumPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + sfSimpleForumForumPeer::NUM_COLUMNS;

		$c->addJoin(sfSimpleForumPostPeer::USER_ID, AccountPeer::ID);

		$c->addJoin(sfSimpleForumPostPeer::FORUM_ID, sfSimpleForumForumPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumPostPeer::getOMClass();

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
					$temp_obj2->addsfSimpleForumPost($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initsfSimpleForumPosts();
				$obj2->addsfSimpleForumPost($obj1);
			}

			$omClass = sfSimpleForumForumPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getsfSimpleForumForum(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addsfSimpleForumPost($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initsfSimpleForumPosts();
				$obj3->addsfSimpleForumPost($obj1);
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

		sfSimpleForumPostPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumPostPeer::NUM_COLUMNS - sfSimpleForumPostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfSimpleForumTopicPeer::NUM_COLUMNS;

		sfSimpleForumForumPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + sfSimpleForumForumPeer::NUM_COLUMNS;

		$c->addJoin(sfSimpleForumPostPeer::TOPIC_ID, sfSimpleForumTopicPeer::ID);

		$c->addJoin(sfSimpleForumPostPeer::FORUM_ID, sfSimpleForumForumPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumPostPeer::getOMClass();

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
					$temp_obj2->addsfSimpleForumPost($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initsfSimpleForumPosts();
				$obj2->addsfSimpleForumPost($obj1);
			}

			$omClass = sfSimpleForumForumPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getsfSimpleForumForum(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addsfSimpleForumPost($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initsfSimpleForumPosts();
				$obj3->addsfSimpleForumPost($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptsfSimpleForumForum(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumPostPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumPostPeer::NUM_COLUMNS - sfSimpleForumPostPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfSimpleForumTopicPeer::NUM_COLUMNS;

		AccountPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AccountPeer::NUM_COLUMNS;

		$c->addJoin(sfSimpleForumPostPeer::TOPIC_ID, sfSimpleForumTopicPeer::ID);

		$c->addJoin(sfSimpleForumPostPeer::USER_ID, AccountPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfSimpleForumPostPeer::getOMClass();

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
					$temp_obj2->addsfSimpleForumPost($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initsfSimpleForumPosts();
				$obj2->addsfSimpleForumPost($obj1);
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
					$temp_obj3->addsfSimpleForumPost($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initsfSimpleForumPosts();
				$obj3->addsfSimpleForumPost($obj1);
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
		return sfSimpleForumPostPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumPostPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasesfSimpleForumPostPeer', $values, $con);
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

		$criteria->remove(sfSimpleForumPostPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BasesfSimpleForumPostPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumPostPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumPostPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasesfSimpleForumPostPeer', $values, $con);
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
			$comparison = $criteria->getComparison(sfSimpleForumPostPeer::ID);
			$selectCriteria->add(sfSimpleForumPostPeer::ID, $criteria->remove(sfSimpleForumPostPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasesfSimpleForumPostPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumPostPeer', $values, $con, $ret);
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
			sfSimpleForumPostPeer::doOnDeleteSetNull(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(sfSimpleForumPostPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(sfSimpleForumPostPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof sfSimpleForumPost) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(sfSimpleForumPostPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			sfSimpleForumPostPeer::doOnDeleteSetNull($criteria, $con);
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected static function doOnDeleteSetNull(Criteria $criteria, Connection $con)
	{

				$objects = sfSimpleForumPostPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {

						$selectCriteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);
			$updateValues = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);
			$selectCriteria->add(sfSimpleForumForumPeer::LATEST_POST_ID, $obj->getId());
			$updateValues->add(sfSimpleForumForumPeer::LATEST_POST_ID, null);

			BasePeer::doUpdate($selectCriteria, $updateValues, $con); 
						$selectCriteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);
			$updateValues = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);
			$selectCriteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $obj->getId());
			$updateValues->add(sfSimpleForumTopicPeer::LATEST_POST_ID, null);

			BasePeer::doUpdate($selectCriteria, $updateValues, $con); 
		}
	}

	
	public static function doValidate(sfSimpleForumPost $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(sfSimpleForumPostPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(sfSimpleForumPostPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(sfSimpleForumPostPeer::DATABASE_NAME, sfSimpleForumPostPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = sfSimpleForumPostPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);

		$criteria->add(sfSimpleForumPostPeer::ID, $pk);


		$v = sfSimpleForumPostPeer::doSelect($criteria, $con);

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
			$criteria->add(sfSimpleForumPostPeer::ID, $pks, Criteria::IN);
			$objs = sfSimpleForumPostPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasesfSimpleForumPostPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/sfSimpleForumPlugin/lib/model/map/sfSimpleForumPostMapBuilder.php';
	Propel::registerMapBuilder('plugins.sfSimpleForumPlugin.lib.model.map.sfSimpleForumPostMapBuilder');
}
