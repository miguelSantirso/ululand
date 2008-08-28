<?php



class ApiSessionMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('apisession');
		$tMap->setPhpName('ApiSession');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('SESSION_ID', 'SessionId', 'string', CreoleTypes::VARCHAR, true, 12);

		$tMap->addColumn('AVATAR_APIKEY', 'AvatarApikey', 'string', CreoleTypes::VARCHAR, true, 13);

		$tMap->addColumn('API_KEY', 'ApiKey', 'string', CreoleTypes::VARCHAR, true, 13);

		$tMap->addColumn('PRIVILEGES_LEVEL', 'PrivilegesLevel', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 