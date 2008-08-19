<?php



class Avatar_GroupMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Avatar_GroupMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('avatar_grupo');
		$tMap->setPhpName('Avatar_Group');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('AVATAR_ID', 'AvatarId', 'int', CreoleTypes::INTEGER, 'avatar', 'ID', false, null);

		$tMap->addForeignKey('GRUPO_ID', 'GrupoId', 'int', CreoleTypes::INTEGER, 'grupo', 'ID', false, null);

		$tMap->addColumn('IS_OWNER', 'IsOwner', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_APPROVED', 'IsApproved', 'boolean', CreoleTypes::BOOLEAN, false, null);

	} 
} 