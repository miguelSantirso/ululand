<?php



class PlayerProfileMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PlayerProfileMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('player_profile');
		$tMap->setPhpName('PlayerProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('USER_PROFILE_ID', 'UserProfileId', 'int', CreoleTypes::INTEGER, 'sf_guard_user_profile', 'ID', true, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('TOTAL_CREDITS', 'TotalCredits', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SPENT_CREDITS', 'SpentCredits', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 