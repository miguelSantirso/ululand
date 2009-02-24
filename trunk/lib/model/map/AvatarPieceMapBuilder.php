<?php



class AvatarPieceMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.AvatarPieceMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(AvatarPiecePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(AvatarPiecePeer::TABLE_NAME);
		$tMap->setPhpName('AvatarPiece');
		$tMap->setClassname('AvatarPiece');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('UUID', 'Uuid', 'VARCHAR', true, 36);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 64);

		$tMap->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 255);

		$tMap->addForeignKey('AUTHOR_ID', 'AuthorId', 'INTEGER', 'sf_guard_user_profile', 'ID', true, null);

		$tMap->addForeignKey('OWNER_ID', 'OwnerId', 'INTEGER', 'sf_guard_user_profile', 'ID', true, null);

		$tMap->addColumn('URL', 'Url', 'VARCHAR', true, 255);

		$tMap->addColumn('PRICE', 'Price', 'INTEGER', false, null);

		$tMap->addColumn('TYPE', 'Type', 'VARCHAR', true, 64);

		$tMap->addColumn('IN_USE', 'InUse', 'BOOLEAN', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

	} 
} 