<?php



class sfGuardUserProfileMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.sfGuardUserProfileMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(sfGuardUserProfilePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(sfGuardUserProfilePeer::TABLE_NAME);
		$tMap->setPhpName('sfGuardUserProfile');
		$tMap->setClassname('sfGuardUserProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('UUID', 'Uuid', 'VARCHAR', true, 36);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null);

		$tMap->addColumn('USERNAME', 'Username', 'VARCHAR', false, 30);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', false, 20);

		$tMap->addColumn('LAST_NAME', 'LastName', 'VARCHAR', false, 20);

		$tMap->addColumn('GENDER', 'Gender', 'INTEGER', true, null);

		$tMap->addColumn('CULTURE', 'Culture', 'VARCHAR', false, 8);

		$tMap->addColumn('IS_APPROVED', 'IsApproved', 'BOOLEAN', true, null);

	} 
} 