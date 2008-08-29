<?php



class PlayerProfile_GroupMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('player_profile_grupo');
		$tMap->setPhpName('PlayerProfile_Group');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PLAYER_PROFILE_ID', 'PlayerProfileId', 'int', CreoleTypes::INTEGER, 'player_profile', 'ID', false, null);

		$tMap->addForeignKey('GRUPO_ID', 'GrupoId', 'int', CreoleTypes::INTEGER, 'grupo', 'ID', false, null);

		$tMap->addColumn('IS_OWNER', 'IsOwner', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_APPROVED', 'IsApproved', 'boolean', CreoleTypes::BOOLEAN, false, null);

	} 
} 