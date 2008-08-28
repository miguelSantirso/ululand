<?php



class GameStatMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.GameStatMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('gamestat');
		$tMap->setPhpName('GameStat');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('GAME_ID', 'GameId', 'int', CreoleTypes::INTEGER, 'game', 'ID', false, null);

		$tMap->addForeignKey('GAMESTATTYPE_ID', 'GamestattypeId', 'int', CreoleTypes::INTEGER, 'gamestattype', 'ID', false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} 
} 