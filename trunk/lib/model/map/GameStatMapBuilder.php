<?php



class GameStatMapBuilder implements MapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap(GameStatPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(GameStatPeer::TABLE_NAME);
		$tMap->setPhpName('GameStat');
		$tMap->setClassname('GameStat');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('UUID', 'Uuid', 'VARCHAR', true, 36);

		$tMap->addForeignKey('GAME_ID', 'GameId', 'INTEGER', 'game', 'ID', false, null);

		$tMap->addColumn('GAMESTATTYPE', 'Gamestattype', 'VARCHAR', true, 6);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 255);

		$tMap->addColumn('STRIPPED_NAME', 'StrippedName', 'VARCHAR', true, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null);

		$tMap->addColumn('SCORE_LABEL', 'ScoreLabel', 'VARCHAR', false, 32);

	} 
} 