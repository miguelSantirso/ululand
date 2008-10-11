/**
 * Clase principal del sistema de representación de avatares físicos
 */

package 
{
	import Box2D.Common.Math.b2Vec2;
	import com.pncil.General.Input;
	import com.pncil.nibiru.DrawablePart;
	import com.pncil.nibiru.Part;
	import com.pncil.nibiru.PhysicalAvatar;
	import com.pncil.nibiru.PhysicalPart;
	import com.pncil.physics.PhysicalEnvironment;
	import flash.display.Bitmap;
	import flash.display.Loader;
	import flash.display.MovieClip;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.net.URLRequest;
	import flash.system.IMEConversionMode;
	import flash.system.LoaderContext;
	
	public class Main extends Sprite
	{
		protected static const ASSETS_URL:String = "http://pfc/uploads/UploadedPieces/";
		/**
		 * Referencia estática al objeto principal
		 */
		public static var autoReference:Main;
		
		/**
		 * Sprite principal, donde se dibujarán las partes finales del representador
		 */
		public var mainSprite:Sprite = new Sprite();
		/**
		 * Sprite de debug, donde se dibujarán los objetos en formato de debug
		 */
		public var debugSprite:Sprite = new Sprite();
		
		/**
		 * Indica si la aplicación ha terminado de cargar o no
		 */
		protected var isReady_:Boolean = false;
		/**
		 * Indica si la aplicación está en modo debug
		 */
		protected var debug_:Boolean = true;
		
		protected var physicalEnvironment_:PhysicalEnvironment;
		
		protected var wall_:PhysicalPart;
		protected var avatar_:PhysicalAvatar;
		
		//protected var drawablePart:DrawablePart;
		/**
		 * Constructor de la clase
		 */
		public function Main():void
		{
			this.addEventListener(Event.ADDED_TO_STAGE, init);
			
			ApiHelper.callbackFunction = callbackFunction;
		}
		
		/**
		 * Inicializa el objeto 
		 */
		protected function init(e:Event):void
		{
			autoReference = this;
			
			addChild(mainSprite);
			updateDebugSprite();
			
			new Input(mainSprite);
			
			addEventListener(Event.ENTER_FRAME, enterFrameEvent);
			
			physicalEnvironment_ = new PhysicalEnvironment(debugSprite, 500, 500);
			
			avatar_ = new PhysicalAvatar(physicalEnvironment_);
			wall_   = new PhysicalPart("../assets/shapes/fixedTriangle.xml", physicalEnvironment_, true);
			avatar_.pinTo(wall_, 0);
			
			requestPartsInfoToServer();
		}
		
		/**
		 * Función necesaria para interactuar con la api
		 * @param	actionName
		 * @param	data
		 */
		public function callbackFunction(actionName:String, data:Object):void
		{
			switch(actionName)
			{
				case "Avatar":
					//setAvatarName(data.Name);
					//setAvatarGender(data.Gender);
					break;
				case "PiecesByOwner":
					startAssetsLoad(data.pieces);
					break;
			}
		}
		
		/**
		 * Actualiza el objeto
		 */
		public function update():void
		{
			if (physicalEnvironment_)
			{
				physicalEnvironment_.update();
			}
			if (avatar_)
			{
				avatar_.update();
			}
			if (Input.isKeyReleased(9))
			{  debug = !debug; trace("debug = " + debug_); }
			
			Input.update();
		}
		
		/**
		 * Inicia la petición al servidor para obtener la información de las partes del avatar
		 */
		protected function requestPartsInfoToServer():void
		{
			ApiHelper.getPiecesByOwner("a30ue7108b66f", "", true);
		}
		
		/**
		 * Lanza la carga de los gráficos del avatar
		 */
		protected function startAssetsLoad(piecesInfo:Array):void
		{
			for each(var piece:Object in piecesInfo)
			{
				var loader:Loader = new Loader();
				loader.load(new URLRequest(ASSETS_URL + piece.url), new LoaderContext(true));
				switch(piece.type)
				{
					case "head":
						loader.contentLoaderInfo.addEventListener(Event.INIT, changeHeadSprite);
					break;
					case "body":
						loader.contentLoaderInfo.addEventListener(Event.INIT, changeBodySprite);
					break;
					case "arm":
						loader.contentLoaderInfo.addEventListener(Event.INIT, changeRightArmSprite);
						loader.contentLoaderInfo.addEventListener(Event.INIT, changeLeftArmSprite);
					break;
					case "leg":
						loader.contentLoaderInfo.addEventListener(Event.INIT, changeRightLegSprite);
						loader.contentLoaderInfo.addEventListener(Event.INIT, changeLeftLegSprite);
					break;
				}
			}
		}
		
		protected function changeHeadSprite(e:Event):void
		{
			changePartSpriteFromEvent(e, 0);
		}
		protected function changeBodySprite(e:Event):void
		{
			changePartSpriteFromEvent(e, 1);
		}
		protected function changeRightArmSprite(e:Event):void
		{
			changePartSpriteFromEvent(e, 2);
		}
		protected function changeLeftArmSprite(e:Event):void
		{
			changePartSpriteFromEvent(e, 3);
		}
		protected function changeRightLegSprite(e:Event):void
		{
			changePartSpriteFromEvent(e, 4);
		}
		protected function changeLeftLegSprite(e:Event):void
		{
			changePartSpriteFromEvent(e, 5);
		}
		protected function changePartSpriteFromEvent(e:Event, part:Number):void
		{
			var bitmap:Bitmap = new Bitmap(e.target.content.bitmapData.clone());
			avatar_.parts[part].setBitmap(bitmap);
		}
		
		/**
		 * Añade o quita el Sprite de debug cuando sea necesario (cuando se activa o desactiva el modo DEBUG).
		 * Esto hace que se dibujen o no los elementos de DEBUG en cada momento.
		 */
		protected function updateDebugSprite():void
		{
			if (!debug_)
			{
				if (contains(debugSprite))
				{
					removeChild(debugSprite);
				}
			}
			else
			{
				if (!contains(debugSprite))
				{
					addChild(debugSprite);
				}
			}
		}
		
		protected function enterFrameEvent(e:Event):void
		{
			update();
		}
		
		public function get debug():Boolean { return debug_; }
		public function set debug(value:Boolean):void 
		{
			debug_ = value;
			updateDebugSprite();
		}
	}
}