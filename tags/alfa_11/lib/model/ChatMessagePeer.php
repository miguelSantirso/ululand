<?php

/**
 * Subclass for performing query and update operations on the 'chat_message' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ChatMessagePeer extends BaseChatMessagePeer
{
	public static function getMessagesHistory($limit)
	{
		$c = new Criteria();
		$c->addDescendingOrderByColumn(ChatMessagePeer::CREATED_AT);
		$c->setLimit($limit);
		
		return ChatMessagePeer::doSelect($c);
	}
	
	public static function getMessagesForUser($user_id, $last_time)
	{
		$c = new Criteria();
		$c->add(ChatMessagePeer::CREATED_AT, $last_time, Criteria::GREATER_EQUAL);
		$c->add(ChatMessagePeer::USER_ID, $user_id, Criteria::NOT_EQUAL);
		return ChatMessagePeer::doSelect($c);
	}
}
