<?php



class TaggingMapBuilder {

	
	const CLASS_NAME = 'plugins.sfPropelActAsTaggableBehaviorPlugin.lib.model.map.TaggingMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sf_tagging');
		$tMap->setPhpName('Tagging');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'ID', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('TAG_ID', 'TagId', 'int', CreoleTypes::INTEGER, 'sf_tag', 'ID', true, null);

		$tMap->addColumn('TAGGABLE_MODEL', 'TaggableModel', 'string', CreoleTypes::VARCHAR, false, 30);

		$tMap->addColumn('TAGGABLE_ID', 'TaggableId', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 