<?php



class GroupMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.GroupMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(GroupPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(GroupPeer::TABLE_NAME);
		$tMap->setPhpName('Group');
		$tMap->setClassname('Group');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 64);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 255);

		$tMap->addColumn('STRIPPED_NAME', 'StrippedName', 'VARCHAR', true, 80);

		$tMap->addColumn('THUMBNAIL_PATH', 'ThumbnailPath', 'VARCHAR', false, 255);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

	} 
} 