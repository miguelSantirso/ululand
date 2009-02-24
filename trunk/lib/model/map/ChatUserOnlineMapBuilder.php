<?php



class ChatUserOnlineMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ChatUserOnlineMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ChatUserOnlinePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ChatUserOnlinePeer::TABLE_NAME);
		$tMap->setPhpName('ChatUserOnline');
		$tMap->setClassname('ChatUserOnline');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('USER_UUID', 'UserUuid', 'VARCHAR', true, 36);

		$tMap->addColumn('USER_NAME', 'UserName', 'VARCHAR', true, 64);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} 
} 