<?php



class CollaborationOfferMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.CollaborationOfferMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(CollaborationOfferPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CollaborationOfferPeer::TABLE_NAME);
		$tMap->setPhpName('CollaborationOffer');
		$tMap->setClassname('CollaborationOffer');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('CREATED_BY', 'CreatedBy', 'INTEGER', 'sf_guard_user', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', true, 75);

		$tMap->addColumn('STRIPPED_TITLE', 'StrippedTitle', 'VARCHAR', true, 75);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', true, null);

	} 
} 