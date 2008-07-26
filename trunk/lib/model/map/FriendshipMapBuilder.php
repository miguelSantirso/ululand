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

		$tMap->addForeignKey('ID_AVATAR_A', 'IdAvatarA', 'int', CreoleTypes::INTEGER, 'avatar', 'ID', true, null);

		$tMap->addColumn('A_CONFIRMED', 'AConfirmed', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addForeignKey('ID_AVATAR_B', 'IdAvatarB', 'int', CreoleTypes::INTEGER, 'avatar', 'ID', true, null);

		$tMap->addColumn('B_CONFIRMED', 'BConfirmed', 'boolean', CreoleTypes::BOOLEAN, false, null);

	} 
} 