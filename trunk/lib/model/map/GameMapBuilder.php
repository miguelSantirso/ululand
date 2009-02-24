<?php



class GameMapBuilder implements MapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap(GamePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(GamePeer::TABLE_NAME);
		$tMap->setPhpName('Game');
		$tMap->setClassname('Game');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('UUID', 'Uuid', 'VARCHAR', true, 36);

		$tMap->addColumn('PRIVILEGES_LEVEL', 'PrivilegesLevel', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 80);

		$tMap->addColumn('STRIPPED_NAME', 'StrippedName', 'VARCHAR', true, 80);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null);

		$tMap->addColumn('INSTRUCTIONS', 'Instructions', 'LONGVARCHAR', false, null);

		$tMap->addForeignKey('CREATED_BY', 'CreatedBy', 'INTEGER', 'sf_guard_user', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('THUMBNAIL_PATH', 'ThumbnailPath', 'VARCHAR', false, 255);

		$tMap->addForeignKey('ACTIVE_RELEASE_ID', 'ActiveReleaseId', 'INTEGER', 'gamerelease', 'ID', false, null);

	} 
} 