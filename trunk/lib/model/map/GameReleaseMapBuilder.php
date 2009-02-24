<?php



class GameReleaseMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('gamerelease');
		$tMap->setPhpName('GameRelease');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('GAME_ID', 'GameId', 'int', CreoleTypes::INTEGER, 'game', 'ID', false, null);

		$tMap->addForeignKey('GAMERELEASESTATUS_ID', 'GamereleasestatusId', 'int', CreoleTypes::INTEGER, 'gamereleasestatus', 'ID', false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 80);

		$tMap->addColumn('STRIPPED_NAME', 'StrippedName', 'string', CreoleTypes::VARCHAR, true, 80);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('IS_PUBLIC', 'IsPublic', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('PASSWORD', 'Password', 'string', CreoleTypes::VARCHAR, false, 13);

		$tMap->addForeignKey('CREATED_BY', 'CreatedBy', 'int', CreoleTypes::INTEGER, 'sf_guard_user', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('GAME_PATH', 'GamePath', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('WIDTH', 'Width', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('HEIGHT', 'Height', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 