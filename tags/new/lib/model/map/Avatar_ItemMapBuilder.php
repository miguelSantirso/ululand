<?php



class Avatar_ItemMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.Avatar_ItemMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('avatar_item');
		$tMap->setPhpName('Avatar_Item');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_AVATAR', 'IdAvatar', 'int', CreoleTypes::INTEGER, 'avatar', 'ID', true, null);

		$tMap->addForeignKey('ID_ITEM', 'IdItem', 'int', CreoleTypes::INTEGER, 'item', 'ID', true, null);

		$tMap->addColumn('ACTIVE', 'Active', 'boolean', CreoleTypes::BOOLEAN, true, null);

	} 
} 