<?php



class DeveloperProfileMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DeveloperProfileMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(DeveloperProfilePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(DeveloperProfilePeer::TABLE_NAME);
		$tMap->setPhpName('DeveloperProfile');
		$tMap->setClassname('DeveloperProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('USER_PROFILE_ID', 'UserProfileId', 'INTEGER', 'sf_guard_user_profile', 'ID', true, null);

		$tMap->addColumn('URL', 'Url', 'VARCHAR', false, 64);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null);

		$tMap->addColumn('IS_FREE', 'IsFree', 'BOOLEAN', false, null);

	} 
} 