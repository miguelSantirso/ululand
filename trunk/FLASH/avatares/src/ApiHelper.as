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
	 * @description Clase que tiene como objetivo ayudar a los desarrolladores a conectarse y comunicarse con la api de la aplicación.
	 * Entre otras cosas, establece la comunicación con el servidor y realiza las tareas de codificación y decodificación de la información.
	 * @usage Se debe tener en cuenta que esta es una clase estática. Esto es así para facilitar su uso. Ver los ejemplos a continuación.
	 * @example <code>// Lo primero que se debe hacer es indicar al ApiHelper cual es la función que recibirá las respuestas del servidor.
	 * <br/>ApiHelper.callbackFunction = myCallbackFunction; 
	 * <br/>ApiHelper.getAvatar("a123456789012"); // Pide al servidor la información del avatar indicado.</code>
	 * @version 8.06
	 * @author Miguel Santirso
	 */
	 
	public class ApiHelper
	{
		/**
		 * Variable que almacena la función a la que se enviarán todas las respuestas del servidor.
		 */
		protected static var callbackFunction_:Function;
		/**
		 * Varable que almacena el escenario del juego
		 */
		protected static var stage_:Stage;
		
		/**
		 * Retorna la versión de la API
		 * @return String la versión de la API
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
		 * Función que inicia una petición al servidor para averiguar los datos de un avatar, dado su apikey.
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
		 * Función que inicia una petición al servidor para modificar el nombre de un avatar, dado su apikey.
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
		 * Función que inicia una petición al servidor para modificar un ítem de un avatar, dado su id.
		 * 
		 *
		 * @example	<code>// Añadir un nuevo objeto y activarlo.<br/>ApiHelper.setAvatarItem(avatarApiKey, newItemId, true)</code>
		 * @example	<code>// Añadir un nuevo objeto sin activarlo.<br/>ApiHelper.setAvatarItem(avatarApiKey, newItemId)</code>
		 * @param	avatarApiKey Api Key del avatar
		 * @param   itemId Id que se desea añadir o activar
		 * @param   activate Indica si se debe activar el ítem
		 */
		public static function setAvatarItem(avatarApiKey:String, itemId:Number, activate:Boolean=false):void
		{
			trace("avatar/setItem(" + avatarApiKey + ", " + itemId +"," + activate + ") called.");
			
			makeRequest("avatar/setItem", "avatarApiKey=" + avatarApiKey + "&itemId=" + itemId + "&active=" + activate).addEventListener(Event.COMPLETE, genericEventHandler);
		}
		
		/**
		 * Función que inicia una petición al servidor para modificar el género de un avatar
		 * 
		 * @example	<code>ApiHelper.setAvatarGender(avatarApiKey, "male")</code>
		 * @param	avatarApiKey Api Key del avatar
		 * @param   itemGender Género del avatar. Los valores válidos son "male" o "female"
		 * @param   activate Indica si se debe activar el ítem
		 */
		public static function setAvatarGender(avatarApiKey:String, itemGender:String):void
		{
			trace("avatar/setGender(" + avatarApiKey + ", " + itemGender + ") called.");
			
			makeRequest("avatar/setGender", "avatarApiKey=" + avatarApiKey + "&avatarGender=" + itemGender).addEventListener(Event.COMPLETE, genericEventHandler);
		}
		
		/**
		 * Función que inicia una petición al servidor para averiguar todos los ítems de un avatar, dada su id
		 * 
		 * @example	<code>// Obtener todos los ítems activos del avatar.<br/>ApiHelper.getAvatarItems(avatarApiKey, true)</code>
		 * @example	<code>// Obtener todos los ítems del avatar (activos o no).<br/>ApiHelper.getAvatarItems(avatarApiKey, true)</code>
		 * @param	avatarApiKey Api Key del avatar
		 */
		public static function getAvatarItems(avatarApiKey:String, filterActive:Boolean=false):void
		{
			trace("avatar/getItems(" + avatarApiKey + ") called.");
			
			makeRequest("avatar/getItems", "avatarApiKey="+avatarApiKey+"&filterActive="+filterActive).addEventListener(Event.COMPLETE, decodeJsonAvatarItems);
		}
		
		/**
		 * Función que inicia una petición al servidor para averiguar todos los ítems disponibles
		 * 
		 * @example	<code>// Obtener todos los ítems del sistema<br/>ApiHelper.getAvailableItems("")</code>
		 * @example	<code>// Obtener todos los ítems de tipo cabeza<br/>ApiHelper.getAvailableItems("head")</code>
		 * @param	filterByType Tipo de los ítems que se desea obtener. Si no se indica nada, se devolverán todos los ítems.
		 */
		public static function getAvailableItems(filterByType:String=""):void
		{
			trace("item/getAll(" + filterByType + ") called.");
			
			makeRequest("item/getAll", (filterByType == "" ? "" : "filterByType=")+filterByType).addEventListener(Event.COMPLETE, decodeJsonAvailableItems);
		}
		
		/**
		 * Pide al servidor todas las piezas poseídas por cierto avatar
		 * @param	avatarApiKey Api Key del avatar del que se desean obtener las piezas
		 * @param	filterByType Permite filtrar los resultados según el tipo
		 * @param	filterInUse Si vale 'true' se retornarán solo las piezas marcadas como en uso.
		 */
		public static function getPiecesByOwner(avatarApiKey:String, filterByType:String="", filterInUse:Boolean = false):void
		{
			trace("item/getAll(" + filterByType + ") called.");
			
			makeRequest("avatarPiece/getByOwner",  "avatarApiKey="+avatarApiKey+(filterByType == "" ? "" : "&filterByType=")+filterByType+(filterInUse ? "&filterInUse=true" : "")).addEventListener(Event.COMPLETE, decodeJsonPiecesByOwner);
		}
		
		/**
		 * Resta la cantidad indicada de créditos a los créditos disponibles del avatar
		 * 
		 * @example	<code>// Obtener los créditos disponibles del avatar.<br/>ApiHelper.getAvatarAvailableCredits(avatarApiKey)</code>
		 * @param	avatarApiKey Api Key del avatar
		 * @param	amount Cantidad de créditos que se restarán.
		 */
		public static function substractCredits(avatarApiKey:String, amount:Number):void
		{
			trace("avatar/substractCredits(" + avatarApiKey + ", " + amount + ") called.");
			
			makeRequest("avatar/substractCredits", "avatarApiKey="+avatarApiKey+"&amount="+amount).addEventListener(Event.COMPLETE, genericEventHandler);
		}
		
		/**
		 * Función que inicia una petición al servidor para averiguar los créditos disonibles de un avatar
		 * 
		 * @example	<code>// Obtener los créditos disponibles del avatar.<br/>ApiHelper.getAvatarAvailableCredits(avatarApiKey)</code>
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
		 * Función que inicia una petición al servidor para averiguar el valor de un gamestat
		 * 
		 * @example	<code>ApiHelper.getGamestat(avatarApiKey, "g1abc2def3ghi", "HighScores");</code>
		 * @param	avatarApiKey ApiKey del avatar
		 * @param	gameApiKey ApiKey del juego
		 * @param	gamestatName Nombre de la estadística a modificar
		 */
		public static function getGamestat(avatarApiKey:String, gameApiKey:String, gamestatName:String):void
		{
			trace("gamestat/getValue("+avatarApiKey+", "+gameApiKey+", "+gamestatName+")")
			
			makeRequest("gamestat/getValue", "avatarApiKey="+avatarApiKey+"&gameApiKey="+gameApiKey+"&gamestatName="+gamestatName).addEventListener(Event.COMPLETE, decodeGamestat);
		}
		
		/**
		 * Función que inicia una petición al servidor para modificar el valor de un gamestat
		 * 
		 * @example	<code>ApiHelper.setGamestat("HighScores", 1999);</code>
		 * @param	gamestatName Nombre de la estadística a modificar
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
		 * Función auxiliar que decodifica una respuesta cualquiera de la API
		 * 
		 * @param	e evento producido al recibirse la respuesta de la API.
		 * @param	actionName nombre de la acción por la que responde la API.
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
		 * Realiza una petición a la api.
		 * @param	requestType Tipo de la petición
		 * @param	parameters Parámetros de la petición
		 * @return URLLoader El cargador que realiza la petición
		 */
		protected static function makeRequest(requestType:String, parameters:String):URLLoader
		{
			// Comprobar si se ha indicado una función de respuesta. En caso de que no sea así se lanza un error
			if (ApiHelper.callbackFunction == null)
			{
				throw new Error("You must set ApiHelper.callbackFunction before calling this function. Read the related documentation to get more information");
			}
			
			// Crear el cargador y la petición (para relizar la petición http)
			var loader:URLLoader = new URLLoader();
			var request:URLRequest = new URLRequest();
			
			// Construir la url de acuerdo al tipo de petición y a los parámetros
			request.url = "http://pfc/api.php/"; // Dirección base de la api
			// Añadir la acción necesaria en función del tipo de petición
			request.url += requestType;
			// Añadir los parámetros
			request.url += "?apiSessionId=";
			request.url += ApiHelper.getApiSessionId();
			request.url += "&";
			if (parameters != "")
			{
				request.url += parameters + "&";
			}
			request.url += "apiType=json"; // Indicar que deseamos la respuesta en formato json
			
			// Realizar y retornar la petición
			trace("Sending request to server: " + request.url);
			loader.load(request);
			return loader;
		}
		
		/**
		 * Retorna una cadena correspondiente al id de la sesión actual con la api
		 * @return id de la sesión actual con la api
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
