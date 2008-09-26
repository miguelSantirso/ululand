<?php



class Competition_PlayerProfileMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('competition_player_profile');
		$tMap->setPhpName('Competition_PlayerProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('COMPETITION_ID', 'CompetitionId', 'int', CreoleTypes::INTEGER, 'competition', 'ID', false, null);

		$tMap->addForeignKey('PLAYER_PROFILE_ID', 'PlayerProfileId', 'int', CreoleTypes::INTEGER, 'player_profile', 'ID', false, null);

		$tMap->addColumn('IS_OWNER', 'IsOwner', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_CONFIRMED', 'IsConfirmed', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 