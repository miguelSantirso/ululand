<?php



class CompetitionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.CompetitionMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(CompetitionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CompetitionPeer::TABLE_NAME);
		$tMap->setPhpName('Competition');
		$tMap->setClassname('Competition');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 80);

		$tMap->addColumn('STRIPPED_NAME', 'StrippedName', 'VARCHAR', true, 80);

		$tMap->addColumn('THUMBNAIL_PATH', 'ThumbnailPath', 'VARCHAR', false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null);

		$tMap->addForeignKey('GAMESTAT_ID', 'GamestatId', 'INTEGER', 'gamestat', 'ID', false, null);

		$tMap->addForeignKey('CREATED_BY', 'CreatedBy', 'INTEGER', 'sf_guard_user', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('STARTS_AT', 'StartsAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('FINISHES_AT', 'FinishesAt', 'TIMESTAMP', true, null);

	} 
} 