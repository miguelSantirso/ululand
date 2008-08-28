<?php



class TagMapBuilder {

	
	const CLASS_NAME = 'plugins.sfPropelActAsTaggableBehaviorPlugin.lib.model.map.TagMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sf_tag');
		$tMap->setPhpName('Tag');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'ID', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('IS_TRIPLE', 'IsTriple', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('TRIPLE_NAMESPACE', 'TripleNamespace', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('TRIPLE_KEY', 'TripleKey', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('TRIPLE_VALUE', 'TripleValue', 'string', CreoleTypes::VARCHAR, false, 100);

	} 
} 