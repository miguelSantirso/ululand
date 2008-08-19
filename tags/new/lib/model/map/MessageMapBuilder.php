<?php



class MessageMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.MessageMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('message');
		$tMap->setPhpName('Message');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_SENDER', 'IdSender', 'int', CreoleTypes::INTEGER, 'avatar', 'ID', true, null);

		$tMap->addForeignKey('ID_RECIPIENT', 'IdRecipient', 'int', CreoleTypes::INTEGER, 'avatar', 'ID', true, null);

		$tMap->addColumn('TEXT', 'Text', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 