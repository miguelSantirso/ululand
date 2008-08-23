<?php



class sfCounterMapBuilder {

	
	const CLASS_NAME = 'plugins.sfPropelActAsCountableBehaviorPlugin.lib.model.map.sfCounterMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sf_counter');
		$tMap->setPhpName('sfCounter');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'ID', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('COUNTABLE_MODEL', 'CountableModel', 'string', CreoleTypes::VARCHAR, false, 30);

		$tMap->addColumn('COUNTABLE_ID', 'CountableId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('COUNTER', 'COUNTER', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 