<?php



class ChatMessageMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('chat_message');
		$tMap->setPhpName('ChatMessage');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('USER_ID', 'UserId', 'string', CreoleTypes::VARCHAR, true, 37);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CHAT_MESSAGE', 'ChatMessage', 'string', CreoleTypes::LONGVARCHAR, true, null);

	} 
} 