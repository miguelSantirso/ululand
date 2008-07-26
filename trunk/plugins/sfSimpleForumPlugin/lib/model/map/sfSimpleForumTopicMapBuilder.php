<?php



class sfSimpleForumTopicMapBuilder {

	
	const CLASS_NAME = 'plugins.sfSimpleForumPlugin.lib.model.map.sfSimpleForumTopicMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sf_simple_forum_topic');
		$tMap->setPhpName('sfSimpleForumTopic');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IS_STICKED', 'IsSticked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_LOCKED', 'IsLocked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addForeignKey('FORUM_ID', 'ForumId', 'int', CreoleTypes::INTEGER, 'sf_simple_forum_forum', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('LATEST_POST_ID', 'LatestPostId', 'int', CreoleTypes::INTEGER, 'sf_simple_forum_post', 'ID', false, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'account', 'ID', false, null);

		$tMap->addColumn('STRIPPED_TITLE', 'StrippedTitle', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('NB_POSTS', 'NbPosts', 'string', CreoleTypes::BIGINT, false, null);

		$tMap->addColumn('NB_VIEWS', 'NbViews', 'string', CreoleTypes::BIGINT, false, null);

	} 
} 