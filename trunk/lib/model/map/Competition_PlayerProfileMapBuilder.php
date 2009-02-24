<?php



class Competition_PlayerProfileMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Competition_PlayerProfileMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(Competition_PlayerProfilePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(Competition_PlayerProfilePeer::TABLE_NAME);
		$tMap->setPhpName('Competition_PlayerProfile');
		$tMap->setClassname('Competition_PlayerProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('COMPETITION_ID', 'CompetitionId', 'INTEGER', 'competition', 'ID', false, null);

		$tMap->addForeignKey('PLAYER_PROFILE_ID', 'PlayerProfileId', 'INTEGER', 'player_profile', 'ID', false, null);

		$tMap->addColumn('IS_OWNER', 'IsOwner', 'BOOLEAN', false, null);

		$tMap->addColumn('IS_CONFIRMED', 'IsConfirmed', 'BOOLEAN', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

	} 
} 