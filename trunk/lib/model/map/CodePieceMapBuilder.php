<?php



class CodePieceMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.CodePieceMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(CodePiecePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CodePiecePeer::TABLE_NAME);
		$tMap->setPhpName('CodePiece');
		$tMap->setClassname('CodePiece');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('UUID', 'Uuid', 'VARCHAR', true, 36);

		$tMap->addForeignKey('CREATED_BY', 'CreatedBy', 'INTEGER', 'sf_guard_user', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('TITLE', 'Title', 'VARCHAR', true, 75);

		$tMap->addColumn('STRIPPED_TITLE', 'StrippedTitle', 'VARCHAR', true, 75);

		$tMap->addColumn('SOURCE', 'Source', 'LONGVARCHAR', true, null);

		$tMap->addColumn('HTML_SOURCE', 'HtmlSource', 'LONGVARCHAR', true, null);

	} 
} 