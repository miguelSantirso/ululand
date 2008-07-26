<?php

require_once dirname(__FILE__).'/../../../lib/apiCommonActions.class.php';

/**
 * chat actions.
 *
 * @package    PFC
 * @subpackage chat
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class chatActions extends apiCommonActions
{
	/**
	 * Executes index action
	 *
	 */
	public function executeIndex()
	{
		$this->forward('default', 'module');
	}

	/**
	 * Inicia una sesi�n de chat para cierto usuario
	 *
	 * Requiere como parámetros:
	 *  - 'avatarApiKey' -- ApiKey del avatar que se conecta al chat
	 * 
	 * Retorna un array con el siguiente formato:
	 *  array('uniqid' => <identificador �nico del usuario en el chat>,
	 *        'username' => <nombre del usuario en el chat>)
	 * 
	 */
	public function executeLogin()
	{
		$activeUsers = ChatUserOnlinePeer::getActiveUsers();
		$usersAmount = count($activeUsers);
		if($usersAmount >= sfConfig::get('app_chat_max_users'))
		{
			$this->setFlash('api_error_code', 5);
			$this->setFlash('api_error_message', "Users max reached." );
			$this->forward('output', 'error');
		}

		// Comprobar que se nos han pasado todos los par�metros necesarios
		$this->checkRequiredParameters( array("avatarApiKey") );
		// ---------------------
		// FIRST ACCESS
		// return its unique id
		// ---------------------
		$uid = md5(uniqid(microtime(), 1)) . getmypid();
		$username = AvatarPeer::retrieveByApiKey($this->getRequestParameter('avatarApiKey'))->getName();
		$newChatUser = new ChatUserOnline();
		$newChatUser->setUserId($uid);
		$newChatUser->setAvatarApiKey($this->getRequestParameter('avatarApiKey'));
		$newChatUser->setUserName($username);
		$newChatUser->save();
		
		$this->returnApi(array('uniqid' => $uid, 'username' => $username));
	}
	
	/**
	 * Recibe y almacena un nuevo mensaje procedente de alg�n usuario del chat
	 *
	 * Requiere como par�metros:
	 *  - 'uniqid' -- Identificador �nico del usuario en el sistema de chat. Este id es el que se retorna en la acci�n 'login'
	 *  - 'message' -- Mensaje enviado por el usuario
	 * 
	 * No retorna nada �til
	 */
	public function executeWriteMessage()
	{	
		// Comprobar que se nos han pasado todos los par�metros necesarios
		$this->checkRequiredParameters( array("uniqid", "message") );
		
		$uniqid = $this->getRequestParameter('uniqid');
		$message = $this->getRequestParameter('message');
		
		if(empty($uniqid) || empty($message))
		{
			$this->setFlash('api_error_code', 5);
			$this->setFlash('api_error_message', "uniqid or message parameters are not valid" );
			$this->forward('output', 'error');
		}
		
		$newMessage = new ChatMessage();
		$newMessage->setUserId($uniqid);
		$newMessage->setChatMessage($message);
		$newMessage->save();
		
		return sfView::NONE;
	}
	
	/**
	 * Retorna los �ltimos mensajes para cierto usuario
	 *
	 * Requiere como parámetros:
	 *  - 'uniqid' -- Identificador �nico del usuario en el sistema de chat. Este id es el que se retorna en la acci�n 'login'
	 * 
	 * Retorna un array con el siguiente formato:
	 *  array(array('chat_message' => <mensaje>, 'chat_data' => <fecha del mensaje>, '<user_name>' => <nombre del usuario>)[,...])
	 * 
	 */
	public function executeReadMessages()
	{
		// Comprobar que se nos han pasado todos los par�metros necesarios
		$this->checkRequiredParameters( array("uniqid") );
		$uniqid = $this->getRequestParameter('uniqid');
		
		// Obtener el usuario que env�a el mensaje
		$user = ChatUserOnlinePeer::retrieveByUserId($uniqid);
		
		$lastTime = $user->getUpdatedAt();
		$user->setUpdatedAt(time());
		$user->save();
		
		$firstTime = $this->getRequestParameter('first_run');
		if($firstTime)
		{
			$messages = ChatMessagePeer::getMessagesHistory(sfConfig::get('app_chat_messages_history'));
		}
		else
		{
			$messages = ChatMessagePeer::getMessagesForUser($uniqid, $lastTime);
		}
		
		$users = ChatUserOnlinePeer::getActiveUsers();
		
		$messagesArray = array();
		$i = 0;
		foreach($messages as $message)
		{
			$messagesArray[$i]["message_body"] = $message->getChatMessage();
			$messagesArray[$i]["message_date"] = $message->getCreatedAt();
			$messagesArray[$i]["user_name"]    = ChatUserOnlinePeer::retrieveByUserId( $message->getUserId() )->getUserName();//ChatUserOnlinePeer::retrieveByUserId( $message->getUserId() )->getUserName();
			
			$i++;
		}
		
		$usersArray = array();
		foreach($users as $user)
		{
			array_push($usersArray, array('user_name' => $user->getUserName(), 
							'last_time' => $user->getUpdatedAt(), 
							'user_id' => $user->getUserId() ));
		}
		
		$responseArray = array('messages' => $messagesArray, 'users' => $usersArray);
		$this->returnApi($responseArray);
	}
}
