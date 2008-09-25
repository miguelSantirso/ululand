<?php



class CompetitionMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('competition');
		$tMap->setPhpName('Competition');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 80);

		$tMap->addColumn('STRIPPED_NAME', 'StrippedName', 'string', CreoleTypes::VARCHAR, true, 80);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('GAMESTAT_ID', 'GamestatId', 'int', CreoleTypes::INTEGER, 'gamestat', 'ID', false, null);

		$tMap->addForeignKey('CREATED_BY', 'CreatedBy', 'int', CreoleTypes::INTEGER, 'sf_guard_user', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('STARTS_AT', 'StartsAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('FINISHES_AT', 'FinishesAt', 'int', CreoleTypes::TIMESTAMP, true, null);

	} 
} 