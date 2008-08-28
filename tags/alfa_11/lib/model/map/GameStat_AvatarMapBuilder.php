<?php



class GameStat_AvatarMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.GameStat_AvatarMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('gamestat_avatar');
		$tMap->setPhpName('GameStat_Avatar');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('GAMESTAT_ID', 'GamestatId', 'int', CreoleTypes::INTEGER, 'gamestat', 'ID', false, null);

		$tMap->addForeignKey('AVATAR_ID', 'AvatarId', 'int', CreoleTypes::INTEGER, 'avatar', 'ID', false, null);

		$tMap->addColumn('VALUE', 'Value', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 