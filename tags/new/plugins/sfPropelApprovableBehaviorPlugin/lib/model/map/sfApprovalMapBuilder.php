<?php



class sfApprovalMapBuilder {

	
	const CLASS_NAME = 'plugins.sfPropelApprovableBehaviorPlugin.lib.model.map.sfApprovalMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sf_approval');
		$tMap->setPhpName('sfApproval');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('APPROVABLE_MODEL', 'ApprovableModel', 'string', CreoleTypes::VARCHAR, false, 30);

		$tMap->addColumn('APPROVABLE_ID', 'ApprovableId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('UUID', 'Uuid', 'string', CreoleTypes::VARCHAR, false, 36);

	} 
} 