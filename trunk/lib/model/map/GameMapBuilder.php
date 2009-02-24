<?php



class GameMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.GameMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('game');
		$tMap->setPhpName('Game');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('UUID', 'Uuid', 'string', CreoleTypes::VARCHAR, true, 36);

		$tMap->addColumn('PRIVILEGES_LEVEL', 'PrivilegesLevel', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 80);

		$tMap->addColumn('STRIPPED_NAME', 'StrippedName', 'string', CreoleTypes::VARCHAR, true, 80);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('INSTRUCTIONS', 'Instructions', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('CREATED_BY', 'CreatedBy', 'int', CreoleTypes::INTEGER, 'sf_guard_user', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('THUMBNAIL_PATH', 'ThumbnailPath', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('ACTIVE_RELEASE_ID', 'ActiveReleaseId', 'int', CreoleTypes::INTEGER, 'gamerelease', 'ID', false, null);

	} 
} 