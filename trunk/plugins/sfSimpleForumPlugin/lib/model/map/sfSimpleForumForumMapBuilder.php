<?php



class sfSimpleForumForumMapBuilder {

	
	const CLASS_NAME = 'plugins.sfSimpleForumPlugin.lib.model.map.sfSimpleForumForumMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sf_simple_forum_forum');
		$tMap->setPhpName('sfSimpleForumForum');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('RANK', 'Rank', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('CATEGORY_ID', 'CategoryId', 'int', CreoleTypes::INTEGER, 'sf_simple_forum_category', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('STRIPPED_NAME', 'StrippedName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('LATEST_POST_ID', 'LatestPostId', 'int', CreoleTypes::INTEGER, 'sf_simple_forum_post', 'ID', false, null);

		$tMap->addColumn('NB_POSTS', 'NbPosts', 'string', CreoleTypes::BIGINT, false, null);

		$tMap->addColumn('NB_TOPICS', 'NbTopics', 'string', CreoleTypes::BIGINT, false, null);

	} 
} 