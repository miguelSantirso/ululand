<?php



class GameReleaseStatusMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.GameReleaseStatusMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(GameReleaseStatusPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(GameReleaseStatusPeer::TABLE_NAME);
		$tMap->setPhpName('GameReleaseStatus');
		$tMap->setClassname('GameReleaseStatus');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 80);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null);

	} 
} 