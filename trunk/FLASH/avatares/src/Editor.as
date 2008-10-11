package  
{
	import com.pncil.nibiru.DrawablePart;
	import flash.display.MovieClip;
	import flash.display.SimpleButton;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.net.URLRequestMethod;
	import flash.net.URLLoaderDataFormat;
	import flash.net.URLVariables;
	import flash.text.TextField;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.utils.ByteArray;
	import Main;
	import ApiHelper;
	import com.dynamicflash.util.Base64;

	/**
	* Clase principal que maneja el comportamiento del editor de avatares físicos
	* @author Miguel Santirso
	*/
	public class Editor extends MovieClip
	{	
		protected var drawableHeadPart_:DrawablePart;
		
		/**
		 * Constructor de la clase
		 */
		public function Editor() 
		{
			trace(this);
			drawableHeadPart_ = new DrawablePart("../assets/shapes/head.xml", this);
			drawableHeadPart_.setPosition(325, 100);
			
			this.addEventListener(Event.ADDED_TO_STAGE, addedToStageEvent);
		}
		
		/**
		 * Función necesaria para interactuar con la api
		 * @param	actionName
		 * @param	data
		 */
		public function callbackFunction(actionName:String, data:Object)
		{
			switch(actionName)
			{
				case "Avatar":
					setAvatarName(data.Name);
					setAvatarGender(data.Gender);
					break;
				case "AvatarAvailableCredits":
					setAvailableCredits(data.avatarAvailableCredits);
					break;
			}
		}
		
		/**
		 * Inicializa la clase una vez se ha añadido al stage
		 */
		protected function initialize():void
		{
			ApiHelper.callbackFunction = callbackFunction;
			ApiHelper.getAvatar("agmlp0qzy2n2i");
			ApiHelper.getAvatarAvailableCredits("agmlp0qzy2n2i");
			
			sendButton.addEventListener(MouseEvent.MOUSE_UP, sendClickedEvent);
		}
		
		protected function setAvatarName(newName:String):void
		{
			nameText.text = newName;
		}
		protected function setAvatarGender(newGender:String):void
		{
			
		}
		protected function setAvailableCredits(credits:Number):void
		{
			availableCreditsText.text = credits.toString();
		}
		protected function addedToStageEvent(e:Event):void
		{
			initialize();
		}
		
		/**
		 * Listener de evento que se ejecuta al ser pulsado el botón de enviar
		 * @param	e
		 */
		protected function sendClickedEvent(e:MouseEvent):void
		{
			var byteArray:ByteArray = drawableHeadPart_.getCanvas().getPngEncoded();
			
			sendToServer(byteArray);
		}
		
		protected function sendToServer(byteArray:ByteArray):void
		{
			var encoded:String = Base64.encodeByteArray(byteArray);
			
			var variables:URLVariables = new URLVariables();
			variables.png = encoded;
			var urlRequest:URLRequest = new URLRequest();
			urlRequest.url='http://localhost/avatars/imageSaver.php';
			urlRequest.method = URLRequestMethod.POST;
			urlRequest.data = variables;
			var loader:URLLoader = new URLLoader();
			loader.dataFormat = URLLoaderDataFormat.BINARY;
			
			loader.load(urlRequest);
			trace("enviado");
		}
		
	}
	
}