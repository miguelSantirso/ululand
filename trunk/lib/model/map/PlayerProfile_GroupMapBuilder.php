<?php



class PlayerProfile_GroupMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PlayerProfile_GroupMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(PlayerProfile_GroupPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(PlayerProfile_GroupPeer::TABLE_NAME);
		$tMap->setPhpName('PlayerProfile_Group');
		$tMap->setClassname('PlayerProfile_Group');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('PLAYER_PROFILE_ID', 'PlayerProfileId', 'INTEGER', 'player_profile', 'ID', false, null);

		$tMap->addForeignKey('GRUPO_ID', 'GrupoId', 'INTEGER', 'grupo', 'ID', false, null);

		$tMap->addColumn('IS_OWNER', 'IsOwner', 'BOOLEAN', false, null);

		$tMap->addColumn('IS_APPROVED', 'IsApproved', 'BOOLEAN', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

	} 
} 