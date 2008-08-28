<?php



class CommentMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.CommentMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('comment');
		$tMap->setPhpName('Comment');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ID_AVATAR', 'IdAvatar', 'int', CreoleTypes::INTEGER, 'avatar', 'ID', true, null);

		$tMap->addForeignKey('ID_GAME', 'IdGame', 'int', CreoleTypes::INTEGER, 'game', 'ID', true, null);

		$tMap->addColumn('TEXT', 'Text', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 