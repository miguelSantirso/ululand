<?php



class AvatarMapBuilder implements MapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap(AvatarPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(AvatarPeer::TABLE_NAME);
		$tMap->setPhpName('Avatar');
		$tMap->setClassname('Avatar');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('PROFILE_ID', 'ProfileId', 'INTEGER', 'sf_guard_user_profile', 'ID', true, null);

		$tMap->addForeignKey('HEAD_ID', 'HeadId', 'INTEGER', 'avatarpiece', 'ID', false, null);

		$tMap->addForeignKey('BODY_ID', 'BodyId', 'INTEGER', 'avatarpiece', 'ID', false, null);

		$tMap->addForeignKey('ARMS_ID', 'ArmsId', 'INTEGER', 'avatarpiece', 'ID', false, null);

		$tMap->addForeignKey('LEGS_ID', 'LegsId', 'INTEGER', 'avatarpiece', 'ID', false, null);

		$tMap->addColumn('UUID', 'Uuid', 'VARCHAR', true, 36);

	} 
} 