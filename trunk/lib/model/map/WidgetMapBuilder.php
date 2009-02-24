<?php



class WidgetMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WidgetMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(WidgetPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(WidgetPeer::TABLE_NAME);
		$tMap->setPhpName('Widget');
		$tMap->setClassname('Widget');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('PRIVILEGES_LEVEL', 'PrivilegesLevel', 'INTEGER', true, null);

		$tMap->addColumn('API_KEY', 'ApiKey', 'VARCHAR', false, 13);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null);

		$tMap->addColumn('URL', 'Url', 'VARCHAR', true, 255);

		$tMap->addColumn('WIDTH', 'Width', 'INTEGER', true, null);

		$tMap->addColumn('HEIGHT', 'Height', 'INTEGER', true, null);

		$tMap->addColumn('BGCOLOR', 'Bgcolor', 'VARCHAR', false, 8);

	} 
} 