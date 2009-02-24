<?php



class GameStat_PlayerProfileMapBuilder implements MapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap(GameStat_PlayerProfilePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(GameStat_PlayerProfilePeer::TABLE_NAME);
		$tMap->setPhpName('GameStat_PlayerProfile');
		$tMap->setClassname('GameStat_PlayerProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('GAMESTAT_ID', 'GamestatId', 'INTEGER', 'gamestat', 'ID', false, null);

		$tMap->addForeignKey('PLAYER_PROFILE_ID', 'PlayerProfileId', 'INTEGER', 'player_profile', 'ID', false, null);

		$tMap->addColumn('VALUE', 'Value', 'INTEGER', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

	} 
} 