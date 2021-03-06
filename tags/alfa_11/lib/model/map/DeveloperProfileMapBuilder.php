<?php



class DeveloperProfileMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('developer_profile');
		$tMap->setPhpName('DeveloperProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('USER_PROFILE_ID', 'UserProfileId', 'int', CreoleTypes::INTEGER, 'sf_guard_user_profile', 'ID', true, null);

		$tMap->addColumn('URL', 'Url', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('IS_FREE', 'IsFree', 'boolean', CreoleTypes::BOOLEAN, false, null);

	} 
} 