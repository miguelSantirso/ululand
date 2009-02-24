<?php



class ApiSessionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ApiSessionMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ApiSessionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ApiSessionPeer::TABLE_NAME);
		$tMap->setPhpName('ApiSession');
		$tMap->setClassname('ApiSession');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('SESSION_ID', 'SessionId', 'VARCHAR', true, 12);

		$tMap->addColumn('USER_UUID', 'UserUuid', 'VARCHAR', true, 36);

		$tMap->addColumn('CLIENT_UUID', 'ClientUuid', 'VARCHAR', true, 36);

		$tMap->addColumn('PRIVILEGES_LEVEL', 'PrivilegesLevel', 'INTEGER', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

	} 
} 