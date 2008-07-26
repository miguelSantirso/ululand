<?php


abstract class BaseWidgetPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'widget';

	
	const CLASS_DEFAULT = 'lib.model.Widget';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'widget.ID';

	
	const PRIVILEGES_LEVEL = 'widget.PRIVILEGES_LEVEL';

	
	const API_KEY = 'widget.API_KEY';

	
	const NAME = 'widget.NAME';

	
	const DESCRIPTION = 'widget.DESCRIPTION';

	
	const URL = 'widget.URL';

	
	const WIDTH = 'widget.WIDTH';

	
	const HEIGHT = 'widget.HEIGHT';

	
	const BGCOLOR = 'widget.BGCOLOR';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'PrivilegesLevel', 'ApiKey', 'Name', 'Description', 'Url', 'Width', 'Height', 'Bgcolor', ),
		BasePeer::TYPE_COLNAME => array (WidgetPeer::ID, WidgetPeer::PRIVILEGES_LEVEL, WidgetPeer::API_KEY, WidgetPeer::NAME, WidgetPeer::DESCRIPTION, WidgetPeer::URL, WidgetPeer::WIDTH, WidgetPeer::HEIGHT, WidgetPeer::BGCOLOR, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'privileges_level', 'api_key', 'name', 'description', 'url', 'width', 'height', 'bgcolor', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PrivilegesLevel' => 1, 'ApiKey' => 2, 'Name' => 3, 'Description' => 4, 'Url' => 5, 'Width' => 6, 'Height' => 7, 'Bgcolor' => 8, ),
		BasePeer::TYPE_COLNAME => array (WidgetPeer::ID => 0, WidgetPeer::PRIVILEGES_LEVEL => 1, WidgetPeer::API_KEY => 2, WidgetPeer::NAME => 3, WidgetPeer::DESCRIPTION => 4, WidgetPeer::URL => 5, WidgetPeer::WIDTH => 6, WidgetPeer::HEIGHT => 7, WidgetPeer::BGCOLOR => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'privileges_level' => 1, 'api_key' => 2, 'name' => 3, 'description' => 4, 'url' => 5, 'width' => 6, 'height' => 7, 'bgcolor' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/WidgetMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.WidgetMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = WidgetPeer::getTableMap();
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
		return str_replace(WidgetPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(WidgetPeer::ID);

		$criteria->addSelectColumn(WidgetPeer::PRIVILEGES_LEVEL);

		$criteria->addSelectColumn(WidgetPeer::API_KEY);

		$criteria->addSelectColumn(WidgetPeer::NAME);

		$criteria->addSelectColumn(WidgetPeer::DESCRIPTION);

		$criteria->addSelectColumn(WidgetPeer::URL);

		$criteria->addSelectColumn(WidgetPeer::WIDTH);

		$criteria->addSelectColumn(WidgetPeer::HEIGHT);

		$criteria->addSelectColumn(WidgetPeer::BGCOLOR);

	}

	const COUNT = 'COUNT(widget.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT widget.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WidgetPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WidgetPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = WidgetPeer::doSelectRS($criteria, $con);
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
		$objects = WidgetPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return WidgetPeer::populateObjects(WidgetPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseWidgetPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseWidgetPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			WidgetPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = WidgetPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return WidgetPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseWidgetPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseWidgetPeer', $values, $con);
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

		$criteria->remove(WidgetPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseWidgetPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseWidgetPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseWidgetPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseWidgetPeer', $values, $con);
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
			$comparison = $criteria->getComparison(WidgetPeer::ID);
			$selectCriteria->add(WidgetPeer::ID, $criteria->remove(WidgetPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseWidgetPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseWidgetPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(WidgetPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(WidgetPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Widget) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(WidgetPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Widget $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(WidgetPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(WidgetPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(WidgetPeer::DATABASE_NAME, WidgetPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = WidgetPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(WidgetPeer::DATABASE_NAME);

		$criteria->add(WidgetPeer::ID, $pk);


		$v = WidgetPeer::doSelect($criteria, $con);

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
			$criteria->add(WidgetPeer::ID, $pks, Criteria::IN);
			$objs = WidgetPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseWidgetPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/WidgetMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.WidgetMapBuilder');
}
