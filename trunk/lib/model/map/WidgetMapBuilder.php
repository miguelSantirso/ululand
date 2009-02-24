<?php



class WidgetMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('widget');
		$tMap->setPhpName('Widget');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PRIVILEGES_LEVEL', 'PrivilegesLevel', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('API_KEY', 'ApiKey', 'string', CreoleTypes::VARCHAR, false, 13);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('URL', 'Url', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('WIDTH', 'Width', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('HEIGHT', 'Height', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('BGCOLOR', 'Bgcolor', 'string', CreoleTypes::VARCHAR, false, 8);

	} 
} 