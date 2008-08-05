<?php



class AvatarMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.AvatarMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('avatar');
		$tMap->setPhpName('Avatar');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PROFILE_ID', 'ProfileId', 'int', CreoleTypes::INTEGER, 'sf_guard_user_profile', 'ID', true, null);

		$tMap->addColumn('API_KEY', 'ApiKey', 'string', CreoleTypes::VARCHAR, false, 13);

		$tMap->addColumn('GENDER', 'Gender', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TOTAL_CREDITS', 'TotalCredits', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SPENT_CREDITS', 'SpentCredits', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 