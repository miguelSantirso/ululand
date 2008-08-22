<?php



class CodePieceLanguageMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.CodePieceLanguageMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('code_piece_language');
		$tMap->setPhpName('CodePieceLanguage');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CODE', 'Code', 'string', CreoleTypes::VARCHAR, true, 8);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 32);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} 
} 