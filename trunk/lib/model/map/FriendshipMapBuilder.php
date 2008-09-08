<?php



class FriendshipMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.FriendshipMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('friendship');
		$tMap->setPhpName('Friendship');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PLAYER_PROFILE_ID_A', 'PlayerProfileIdA', 'int', CreoleTypes::INTEGER, 'player_profile', 'ID', false, null);

		$tMap->addForeignKey('PLAYER_PROFILE_ID_B', 'PlayerProfileIdB', 'int', CreoleTypes::INTEGER, 'player_profile', 'ID', false, null);

		$tMap->addColumn('IS_CONFIRMED', 'IsConfirmed', 'boolean', CreoleTypes::BOOLEAN, false, null);

	} 
} 