<?php



class FriendshipMapBuilder implements MapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap(FriendshipPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(FriendshipPeer::TABLE_NAME);
		$tMap->setPhpName('Friendship');
		$tMap->setClassname('Friendship');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('PLAYER_PROFILE_ID_A', 'PlayerProfileIdA', 'INTEGER', 'player_profile', 'ID', false, null);

		$tMap->addForeignKey('PLAYER_PROFILE_ID_B', 'PlayerProfileIdB', 'INTEGER', 'player_profile', 'ID', false, null);

		$tMap->addColumn('IS_CONFIRMED', 'IsConfirmed', 'BOOLEAN', false, null);

	} 
} 