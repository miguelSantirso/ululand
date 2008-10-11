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
	 * @example <code>// Lo primero que se debe hacer es iniciar el ApiHelper:
	 * <br/>ApiHelper.init(myStage, myCallbackFunction);
	 * <br/>Después, simplemente hay que utilizar las funciones de petición de datos al servidor
	 * <br/>ApiHelper.getPlayer(myPlayerUuid); // Pide al servidor la información del avatar indicado.</code>
	 * @version 8.10
	 * @author Miguel Santirso <http://miguelSantirso.es> para pncil <http://pncil.com>
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
			return "8.10";
		}
		
		public static function init(stage:Stage, callbackFunction:Function):void
		{
			ApiHelper.callbackFunction_ = callbackFunction;
			stage_ = stage;
		}
		
		/* Funciones de acceso al Jugador */
		
		/**
		 * Función que inicia una petición al servidor para averiguar los datos de un jugador, dado su uuid.
		 * 
		 * @example	<code>ApiHelper.getAvatar(userUuid);</code>
		 * @param	userUuid Uuid del avatar
		 */
		public static function getPlayer(userUuid:String):void
		{
			trace("player/get(" + userUuid + ") called.");
			
			if (userUuid == "")
			{
				throw new Error("The userUuid passed as parameter is empty to ApiHelper.getPlayer function is empty");
			}
			
			makeRequest("player/get", "userUuid="+userUuid).addEventListener(Event.COMPLETE, decodeJsonPlayerName);
		}
		
		/**
		 * Resta la cantidad indicada de créditos a los créditos disponibles del avatar
		 * 
		 * @example	<code>// Restar cierta cantidad de créditos del jugador.<br/>ApiHelper.substractCredits(playerUuid)</code>
		 * @param	userUuid Uuid del jugador
		 * @param	amount Cantidad de créditos que se restarán.
		 */
		public static function substractPlayerCredits(userUuid:String, amount:Number):void
		{
			trace("player/substractCredits(" + userUuid + ", " + amount + ") called.");
			
			if (userUuid == "")
			{
				throw new Error("The userUuid passed as parameter is empty to ApiHelper.getPlayer function is empty");
			}
			
			makeRequest("player/substractCredits", "userUuid="+userUuid+"&amount="+amount).addEventListener(Event.COMPLETE, genericEventHandler);
		}
		
		/**
		 * Función que inicia una petición al servidor para averiguar los créditos disonibles de un jugador
		 * 
		 * @example	<code>// Obtener los créditos disponibles del jugador.<br/>ApiHelper.getPlayerAvailableCredits(playerUuid)</code>
		 * @param	userUuid Uuid del jugador
		 */
		public static function getPlayerAvailableCredits(userUuid:String):void
		{
			trace("player/getAvailableCredits(" + userUuid + ") called.");
			
			if (userUuid == "")
			{
				throw new Error("The userUuid passed as parameter is empty to ApiHelper.getPlayer function is empty");
			}
			
			makeRequest("player/getAvailableCredits", "userUuid="+userUuid).addEventListener(Event.COMPLETE, decodeJsonPlayerCredits);
		}
		
		
		/* Funciones de avatares */
		
		/**
		 * Función que inicia una petición al servidor para averiguar los datos de una pieza de avatar, dado su uuid
		 * 
		 * @example	<code>ApiHelper.getAvatarPiece(pieceUuid);</code>
		 * @param	pieceUuid Uuid de la pieza de avatar
		 */
		public static function getAvatarPiece(pieceUuid:String):void
		{
			trace("avatarPiece/get(" + pieceUuid + ") called.");
			
			makeRequest("avatarPiece/get", "pieceUuid="+pieceUuid).addEventListener(Event.COMPLETE, decodeJsonAvatarPiece);
		}
		
		
		/**
		 * Pide al servidor todas las piezas de las que se compone el avatar de cierto usuario
		 * @param	userUuid Uuid del jugador de cuyo avatar se desean obtener las piezas
		 * @param	filterByType Permite filtrar los resultados según el tipo
		 * @param	filterInUse Si vale 'true' se retornarán solo las piezas marcadas como en uso.
		 */
		public static function getPiecesByOwner(userUuid:String, filterByType:String="", filterInUse:Boolean = false):void
		{
			trace("avatarPiece/getPiecesByOwner(" + userUuid + ", " + filterByType + ", " + filterInUse + ") called.");
			
			if (userUuid == "")
			{
				throw new Error("The userUuid passed as parameter is empty to ApiHelper.getPlayer function is empty");
			}
			
			makeRequest("avatarPiece/getByOwner",  "userUuid="+userUuid+(filterByType == "" ? "" : "&filterByType=")+filterByType+(filterInUse ? "&filterInUse=true" : "")).addEventListener(Event.COMPLETE, decodeJsonPiecesByOwner);
		}
		
		
		
		/* Funciones del sistema de Gamestats */
		
		/**
		 * Función que inicia una petición al servidor para averiguar el valor de un gamestat
		 * 
		 * @example	<code>ApiHelper.getGamestat(userUuid, gameUuid, "HighScores");</code>
		 * @param	userUuid Uuid del avatar
		 * @param	gameUuid Uuid del juego
		 * @param	gamestatName Nombre de la estadística a modificar
		 */
		public static function getGamestat(userUuid:String, gameUuid:String, gamestatName:String):void
		{
			trace("gamestat/getValue("+userUuid+", "+gameUuid+", "+gamestatName+")")
			
			if (userUuid == "")
			{
				throw new Error("The userUuid passed as parameter is empty to ApiHelper.getPlayer function is empty");
			}
			
			makeRequest("gamestat/getValue", "userUuid="+userUuid+"&gameUuid="+gameUuid+"&gamestatName="+gamestatName).addEventListener(Event.COMPLETE, decodeGamestat);
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
		protected static function decodeJsonPlayerName(e:Event):void
		{
			genericDecode(e, "Player");
		}
		/**
		 * Callback que procesa una respuesta del servidor
		 * @param	e
		 */
		protected static function decodeJsonAvatarPiece(e:Event):void
		{
			genericDecode(e, "AvatarPiece");
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
		protected static function decodeJsonPlayerCredits(e:Event):void
		{
			genericDecode(e, "PlayerAvailableCredits");
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
			request.url = "http://ululand/api.php/"; // Dirección base de la api
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
			//return "jq0suf4ymu2g";
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
