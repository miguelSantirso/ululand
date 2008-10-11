package
{
	import flash.display.Loader;
	import flash.display.Stage;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.events.Event;
	import com.adobe.serialization.json.JSON;
	import mx.controls.Alert;
	import mx.core.Application;
	
	/**
	 * @description Clase que tiene como objetivo ayudar a los desarrolladores a conectarse y comunicarse con la api de la aplicaci�n.
	 * Entre otras cosas, establece la comunicaci�n con el servidor y realiza las tareas de codificaci�n y decodificaci�n de la informaci�n.
	 * @usage Se debe tener en cuenta que esta es una clase est�tica. Esto es as� para facilitar su uso. Ver los ejemplos a continuaci�n.
	 * @example <code>// Lo primero que se debe hacer es indicar al ApiHelper cual es la funci�n que recibir� las respuestas del servidor.
	 * <br/>ApiHelper.callbackFunction = myCallbackFunction; 
	 * <br/>ApiHelper.getAvatar("a123456789012"); // Pide al servidor la informaci�n del avatar indicado.</code>
	 * @version 8.06
	 * @author Miguel Santirso
	 */
	 
	public class ApiHelper
	{
		/**
		 * Variable que almacena la funci�n a la que se enviar�n todas las respuestas del servidor.
		 */
		protected static var callbackFunction_:Function;
		/**
		 * Varable que almacena el escenario del juego
		 */
		protected static var stage_:Stage;
		
		/**
		 * Retorna la versi�n de la API
		 * @return String la versi�n de la API
		 */
		public static function getVersion():String
		{
			return "8.07";
		}
		
		public static function init(stage:Stage, callbackFunction:Function):void
		{
			ApiHelper.callbackFunction_ = callbackFunction;
			stage_ = stage;
		}
		
		/**
		 * Funci�n que inicia una petici�n al servidor para averiguar los datos de un avatar, dado su apikey.
		 * 
		 * @example	<code>ApiHelper.getAvatar(avatarApiKey);</code>
		 * @param	avatarApiKey Api Key del avatar
		 */
		public static function getAvatar(avatarApiKey:String):void
		{
			trace("avatar/get(" + avatarApiKey + ") called.");
			
			makeRequest("avatar/get", "avatarApiKey="+avatarApiKey).addEventListener(Event.COMPLETE, decodeJsonAvatarName);
		}
		
		/**
		 * Funci�n que inicia una petici�n al servidor para modificar el nombre de un avatar, dado su apikey.
		 * 
		 * @example	<code>ApiHelper.setAvatarName(avatarApiKey, "Nombre Nuevo")</code>
		 * @param	avatarApiKey Api Key del avatar
		 * @param   newAvatarName Nuevo nombre para el avatar
		 */
		public static function setAvatarName(avatarApiKey:String, newAvatarName:String):void
		{
			trace("avatar/setName(" + avatarApiKey + ", " + newAvatarName +") called.");
			
			makeRequest("avatar/setName", "avatarApiKey=" + avatarApiKey + "&avatarName=" + newAvatarName).addEventListener(Event.COMPLETE, genericEventHandler);
		}
		
		/**
		 * Funci�n que inicia una petici�n al servidor para modificar un �tem de un avatar, dado su id.
		 * 
		 *
		 * @example	<code>// A�adir un nuevo objeto y activarlo.<br/>ApiHelper.setAvatarItem(avatarApiKey, newItemId, true)</code>
		 * @example	<code>// A�adir un nuevo objeto sin activarlo.<br/>ApiHelper.setAvatarItem(avatarApiKey, newItemId)</code>
		 * @param	avatarApiKey Api Key del avatar
		 * @param   itemId Id que se desea a�adir o activar
		 * @param   activate Indica si se debe activar el �tem
		 */
		public static function setAvatarItem(avatarApiKey:String, itemId:Number, activate:Boolean=false):void
		{
			trace("avatar/setItem(" + avatarApiKey + ", " + itemId +"," + activate + ") called.");
			
			makeRequest("avatar/setItem", "avatarApiKey=" + avatarApiKey + "&itemId=" + itemId + "&active=" + activate).addEventListener(Event.COMPLETE, genericEventHandler);
		}
		
		/**
		 * Funci�n que inicia una petici�n al servidor para modificar el g�nero de un avatar
		 * 
		 * @example	<code>ApiHelper.setAvatarGender(avatarApiKey, "male")</code>
		 * @param	avatarApiKey Api Key del avatar
		 * @param   itemGender G�nero del avatar. Los valores v�lidos son "male" o "female"
		 * @param   activate Indica si se debe activar el �tem
		 */
		public static function setAvatarGender(avatarApiKey:String, itemGender:String):void
		{
			trace("avatar/setGender(" + avatarApiKey + ", " + itemGender + ") called.");
			
			makeRequest("avatar/setGender", "avatarApiKey=" + avatarApiKey + "&avatarGender=" + itemGender).addEventListener(Event.COMPLETE, genericEventHandler);
		}
		
		/**
		 * Funci�n que inicia una petici�n al servidor para averiguar todos los �tems de un avatar, dada su id
		 * 
		 * @example	<code>// Obtener todos los �tems activos del avatar.<br/>ApiHelper.getAvatarItems(avatarApiKey, true)</code>
		 * @example	<code>// Obtener todos los �tems del avatar (activos o no).<br/>ApiHelper.getAvatarItems(avatarApiKey, true)</code>
		 * @param	avatarApiKey Api Key del avatar
		 */
		public static function getAvatarItems(avatarApiKey:String, filterActive:Boolean=false):void
		{
			trace("avatar/getItems(" + avatarApiKey + ") called.");
			
			makeRequest("avatar/getItems", "avatarApiKey="+avatarApiKey+"&filterActive="+filterActive).addEventListener(Event.COMPLETE, decodeJsonAvatarItems);
		}
		
		/**
		 * Funci�n que inicia una petici�n al servidor para averiguar todos los �tems disponibles
		 * 
		 * @example	<code>// Obtener todos los �tems del sistema<br/>ApiHelper.getAvailableItems("")</code>
		 * @example	<code>// Obtener todos los �tems de tipo cabeza<br/>ApiHelper.getAvailableItems("head")</code>
		 * @param	filterByType Tipo de los �tems que se desea obtener. Si no se indica nada, se devolver�n todos los �tems.
		 */
		public static function getAvailableItems(filterByType:String=""):void
		{
			trace("item/getAll(" + filterByType + ") called.");
			
			makeRequest("item/getAll", (filterByType == "" ? "" : "filterByType=")+filterByType).addEventListener(Event.COMPLETE, decodeJsonAvailableItems);
		}
		
		/**
		 * Pide al servidor todas las piezas pose�das por cierto avatar
		 * @param	avatarApiKey Api Key del avatar del que se desean obtener las piezas
		 * @param	filterByType Permite filtrar los resultados seg�n el tipo
		 * @param	filterInUse Si vale 'true' se retornar�n solo las piezas marcadas como en uso.
		 */
		public static function getPiecesByOwner(avatarApiKey:String, filterByType:String="", filterInUse:Boolean = false):void
		{
			trace("item/getAll(" + filterByType + ") called.");
			
			makeRequest("avatarPiece/getByOwner",  "avatarApiKey="+avatarApiKey+(filterByType == "" ? "" : "&filterByType=")+filterByType+(filterInUse ? "&filterInUse=true" : "")).addEventListener(Event.COMPLETE, decodeJsonPiecesByOwner);
		}
		
		/**
		 * Resta la cantidad indicada de cr�ditos a los cr�ditos disponibles del avatar
		 * 
		 * @example	<code>// Obtener los cr�ditos disponibles del avatar.<br/>ApiHelper.getAvatarAvailableCredits(avatarApiKey)</code>
		 * @param	avatarApiKey Api Key del avatar
		 * @param	amount Cantidad de cr�ditos que se restar�n.
		 */
		public static function substractCredits(avatarApiKey:String, amount:Number):void
		{
			trace("avatar/substractCredits(" + avatarApiKey + ", " + amount + ") called.");
			
			makeRequest("avatar/substractCredits", "avatarApiKey="+avatarApiKey+"&amount="+amount).addEventListener(Event.COMPLETE, genericEventHandler);
		}
		
		/**
		 * Funci�n que inicia una petici�n al servidor para averiguar los cr�ditos disonibles de un avatar
		 * 
		 * @example	<code>// Obtener los cr�ditos disponibles del avatar.<br/>ApiHelper.getAvatarAvailableCredits(avatarApiKey)</code>
		 * @param	avatarApiKey Api Key del avatar
		 */
		public static function getAvatarAvailableCredits(avatarApiKey:String):void
		{
			trace("avatar/getAvailableCredits(" + avatarApiKey + ") called.");
			
			makeRequest("avatar/getAvailableCredits", "avatarApiKey="+avatarApiKey).addEventListener(Event.COMPLETE, decodeJsonAvatarCredits);
		}
		
		//////////////////////////
		// API DE GAMESTATS
		//////////////////////////
		
		/**
		 * Funci�n que inicia una petici�n al servidor para averiguar el valor de un gamestat
		 * 
		 * @example	<code>ApiHelper.getGamestat(avatarApiKey, "g1abc2def3ghi", "HighScores");</code>
		 * @param	avatarApiKey ApiKey del avatar
		 * @param	gameApiKey ApiKey del juego
		 * @param	gamestatName Nombre de la estad�stica a modificar
		 */
		public static function getGamestat(avatarApiKey:String, gameApiKey:String, gamestatName:String):void
		{
			trace("gamestat/getValue("+avatarApiKey+", "+gameApiKey+", "+gamestatName+")")
			
			makeRequest("gamestat/getValue", "avatarApiKey="+avatarApiKey+"&gameApiKey="+gameApiKey+"&gamestatName="+gamestatName).addEventListener(Event.COMPLETE, decodeGamestat);
		}
		
		/**
		 * Funci�n que inicia una petici�n al servidor para modificar el valor de un gamestat
		 * 
		 * @example	<code>ApiHelper.setGamestat("HighScores", 1999);</code>
		 * @param	gamestatName Nombre de la estad�stica a modificar
		 * @param	gamestatValue Valor que se desea enviar al servidor para el gamestat
		 */
		public static function setGamestat(gamestatName:String, value:Number):void
		{
			trace("gamestat/setValue("+gamestatName+", "+value+")")
			
			makeRequest("gamestat/setValue", "gamestatName="+gamestatName+"&value="+value).addEventListener(Event.COMPLETE, genericEventHandler);
		}
		
		
		
		
		
		
		
		
		
		
		/*************************************************************
		 * 
		 * FUNCIONES AUXILIARES
		 * 
		 * ***********************************************************/
		
		/**
		 * Callback que procesa una respuesta del servidor
		 * @param	e
		 */
		protected static function decodeJsonAvatarName(e:Event):void
		{
			genericDecode(e, "Avatar");
		}
		/**
		 * Callback que procesa una respuesta del servidor
		 * @param	e
		 */
		protected static function decodeJsonAvatarItems(e:Event):void
		{
			genericDecode(e, "AvatarItems");
		}
		/**
		 * Callback que procesa una respuesta del servidor
		 * @param	e
		 */
		protected static function decodeJsonPiecesByOwner(e:Event):void
		{
			genericDecode(e, "PiecesByOwner");
		}
		/**
		 * Callback que procesa una respuesta del servidor
		 * @param	e
		 */
		protected static function decodeJsonAvailableItems(e:Event):void
		{
			genericDecode(e, "AvailableItems");
		}
		/**
		 * Callback que procesa una respuesta del servidor
		 * @param	e
		 */
		protected static function decodeJsonAvatarCredits(e:Event):void
		{
			genericDecode(e, "AvatarAvailableCredits");
		}
		/**
		 * Callback que procesa una respuesta del servidor
		 * @param	e
		 */
		protected static function decodeGamestat(e:Event):void
		{
			genericDecode(e, "GetValue");
		}
		
		/**
		 * Funci�n auxiliar que decodifica una respuesta cualquiera de la API
		 * 
		 * @param	e evento producido al recibirse la respuesta de la API.
		 * @param	actionName nombre de la acci�n por la que responde la API.
		 */
		protected static function genericDecode(e:Event, actionName:String):void
		{
			var decodedResponse:Object;
			var loader:URLLoader = URLLoader(e.target);
			try
			{
				decodedResponse = JSON.decode(loader.data);
			}
			catch (error:Error)
			{
				throw new Error("Error when decoding response for "+actionName+".\nMessage from API: "+loader.data+".\nError message: "+error);
			}
			
			try
			{
				ApiHelper.callbackFunction(actionName, decodedResponse);
			}
			catch (error:Error)
			{
				throw new Error("Error while invoking your callback function. Please, check your function for errors.\nError message: "+error);
			}
		}
		
		protected static function genericEventHandler(e:Event):void
		{
			var loader:URLLoader = URLLoader(e.target);
			trace(loader.data);
		}
		
		/**
		 * Realiza una petici�n a la api.
		 * @param	requestType Tipo de la petici�n
		 * @param	parameters Par�metros de la petici�n
		 * @return URLLoader El cargador que realiza la petici�n
		 */
		protected static function makeRequest(requestType:String, parameters:String):URLLoader
		{
			// Comprobar si se ha indicado una funci�n de respuesta. En caso de que no sea as� se lanza un error
			if (ApiHelper.callbackFunction == null)
			{
				throw new Error("You must set ApiHelper.callbackFunction before calling this function. Read the related documentation to get more information");
			}
			
			// Crear el cargador y la petici�n (para relizar la petici�n http)
			var loader:URLLoader = new URLLoader();
			var request:URLRequest = new URLRequest();
			
			// Construir la url de acuerdo al tipo de petici�n y a los par�metros
			request.url = "http://pfc/api.php/"; // Direcci�n base de la api
			// A�adir la acci�n necesaria en funci�n del tipo de petici�n
			request.url += requestType;
			// A�adir los par�metros
			request.url += "?apiSessionId=";
			request.url += ApiHelper.getApiSessionId();
			request.url += "&";
			if (parameters != "")
			{
				request.url += parameters + "&";
			}
			request.url += "apiType=json"; // Indicar que deseamos la respuesta en formato json
			
			// Realizar y retornar la petici�n
			trace("Sending request to server: " + request.url);
			loader.load(request);
			return loader;
		}
		
		/**
		 * Retorna una cadena correspondiente al id de la sesi�n actual con la api
		 * @return id de la sesi�n actual con la api
		 */
		public static function getApiSessionId():String
		{
			//return "6ljj43zmnqdu";
			return stage_.root.loaderInfo.parameters.apiSessionId;
		}
		
		public static function get callbackFunction():Function
		{
			return ApiHelper.callbackFunction_;
		}
		public static function set callbackFunction(newCallbackFunction:Function):void
		{
			ApiHelper.callbackFunction_ = newCallbackFunction;
		}
		
	}
}
