<?php

/**
 * Subclass for performing query and update operations on the 'chat_useronline' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ChatUserOnlinePeer extends BaseChatUserOnlinePeer
{
	public static function getActiveUsers()
	{
		$c = new Criteria();
		$thresholdDate = time () - sfConfig::get('app_chat_active_time', 0);
		$c->add(ChatUserOnlinePeer::UPDATED_AT, date ("Y-m-d H:i:s", $thresholdDate), Criteria::GREATER_THAN);
		$activeUsers = ChatUserOnlinePeer::doSelect($c);
		
		return $activeUsers;
	}
	
	public static function retrieveByUserId($userId)
	{
		$c = new Criteria();
		$c->add(ChatUserOnlinePeer::USER_ID, $userId);
		return ChatUserOnlinePeer::doSelectOne($c);
	}

	
}
