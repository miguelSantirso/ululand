<?php



class PlayerProfileMapBuilder implements MapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap(PlayerProfilePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PlayerProfilePeer::TABLE_NAME);
		$tMap->setPhpName('PlayerProfile');
		$tMap->setClassname('PlayerProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('USER_PROFILE_ID', 'UserProfileId', 'INTEGER', 'sf_guard_user_profile', 'ID', true, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null);

		$tMap->addColumn('TOTAL_CREDITS', 'TotalCredits', 'INTEGER', false, null);

		$tMap->addColumn('SPENT_CREDITS', 'SpentCredits', 'INTEGER', false, null);

	} 
} 