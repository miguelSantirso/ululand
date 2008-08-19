<?php



class AccountMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.AccountMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('account');
		$tMap->setPhpName('Account');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('HASHEDPASSWORD', 'Hashedpassword', 'string', CreoleTypes::VARCHAR, true, 64);

		$tMap->addColumn('SALT', 'Salt', 'string', CreoleTypes::VARCHAR, true, 4);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CONFIRMATION_DATE', 'ConfirmationDate', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ACCOUNT_LEVEL', 'AccountLevel', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('SESSIONID', 'Sessionid', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('IS_APPROVED', 'IsApproved', 'boolean', CreoleTypes::BOOLEAN, false, null);

	} 
} 