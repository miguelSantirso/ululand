<?php



class GameReleaseMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.GameReleaseMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(GameReleasePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(GameReleasePeer::TABLE_NAME);
		$tMap->setPhpName('GameRelease');
		$tMap->setClassname('GameRelease');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('GAME_ID', 'GameId', 'INTEGER', 'game', 'ID', false, null);

		$tMap->addForeignKey('GAMERELEASESTATUS_ID', 'GamereleasestatusId', 'INTEGER', 'gamereleasestatus', 'ID', false, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 80);

		$tMap->addColumn('STRIPPED_NAME', 'StrippedName', 'VARCHAR', true, 80);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null);

		$tMap->addColumn('IS_PUBLIC', 'IsPublic', 'BOOLEAN', true, null);

		$tMap->addColumn('PASSWORD', 'Password', 'VARCHAR', false, 13);

		$tMap->addForeignKey('CREATED_BY', 'CreatedBy', 'INTEGER', 'sf_guard_user', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('GAME_PATH', 'GamePath', 'VARCHAR', true, 255);

		$tMap->addColumn('WIDTH', 'Width', 'INTEGER', false, null);

		$tMap->addColumn('HEIGHT', 'Height', 'INTEGER', false, null);

	} 
} 