<?php



class GameStat_PlayerProfileMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.GameStat_PlayerProfileMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('gamestat_player_profile');
		$tMap->setPhpName('GameStat_PlayerProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('GAMESTAT_ID', 'GamestatId', 'int', CreoleTypes::INTEGER, 'gamestat', 'ID', false, null);

		$tMap->addForeignKey('PLAYER_PROFILE_ID', 'PlayerProfileId', 'int', CreoleTypes::INTEGER, 'player_profile', 'ID', false, null);

		$tMap->addColumn('VALUE', 'Value', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 