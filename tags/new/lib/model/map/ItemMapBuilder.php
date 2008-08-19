<?php



class ItemMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ItemMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('item');
		$tMap->setPhpName('Item');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 64);

		$tMap->addColumn('GENDER', 'Gender', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_ITEMTYPE', 'IdItemtype', 'int', CreoleTypes::INTEGER, 'itemtype', 'ID', true, null);

		$tMap->addColumn('URL', 'Url', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('PRICE', 'Price', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 