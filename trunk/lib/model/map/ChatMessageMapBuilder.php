<?php



class ChatMessageMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ChatMessageMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(ChatMessagePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ChatMessagePeer::TABLE_NAME);
		$tMap->setPhpName('ChatMessage');
		$tMap->setClassname('ChatMessage');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('USER_UUID', 'UserUuid', 'VARCHAR', true, 36);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('CHAT_MESSAGE', 'ChatMessage', 'LONGVARCHAR', true, null);

	} 
} 