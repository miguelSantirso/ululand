<?php



class AvatarMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.AvatarMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('avatar');
		$tMap->setPhpName('Avatar');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PROFILE_ID', 'ProfileId', 'int', CreoleTypes::INTEGER, 'sf_guard_user_profile', 'ID', true, null);

		$tMap->addForeignKey('HEAD_ID', 'HeadId', 'int', CreoleTypes::INTEGER, 'avatarpiece', 'ID', false, null);

		$tMap->addForeignKey('BODY_ID', 'BodyId', 'int', CreoleTypes::INTEGER, 'avatarpiece', 'ID', false, null);

		$tMap->addForeignKey('ARMS_ID', 'ArmsId', 'int', CreoleTypes::INTEGER, 'avatarpiece', 'ID', false, null);

		$tMap->addForeignKey('LEGS_ID', 'LegsId', 'int', CreoleTypes::INTEGER, 'avatarpiece', 'ID', false, null);

		$tMap->addColumn('UUID', 'Uuid', 'string', CreoleTypes::VARCHAR, true, 36);

	} 
} 