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
	import com.onebyonedesign.utils.OBO_ToolTip;
	import flash.events.MouseEvent;
	import flash.display.Bitmap;
	import flash.display.Loader;
	import flash.display.MovieClip;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.net.URLRequest;
	import flash.system.IMEConversionMode;
	import flash.system.LoaderContext;
	import flash.display.StageScaleMode;
	
	public class AutoAvatar extends Sprite
	{
		public static const ASSETS_URL:String = "http://ululand/uploads/UploadedPieces/";
		public static const SHAPES_URL:String = ASSETS_URL + "shapes/";
		/**
		 * Referencia estática al objeto principal
		 */
		public static var autoReference:AutoAvatar;
		
		/**
		 * Sprite principal, donde se dibujarán las partes finales del representador
		 */
		public var mainSprite:Sprite = new Sprite();
		/**
		 * Sprite de debug, donde se dibujarán los objetos en formato de debug
		 */
		public var debugSprite:Sprite = new Sprite();
		
		/**
		 * Tooltip que muestra el nombre del avatar al pasar el ratón por encima
		 */
		protected var tooltip_:OBO_ToolTip;
		
		/**
		 * Indica si la aplicación ha terminado de cargar o no
		 */
		protected var isReady_:Boolean = false;
		/**
		 * Indica si la aplicación está en modo debug
		 */
		protected var debug_:Boolean = false;
		
		protected var physicalEnvironment_:PhysicalEnvironment;
		
		protected var avatars:Object = new Object;
		
		/**
		 * Constructor de la clase
		 */
		public function AutoAvatar():void
		{	
			this.addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		/**
		 * Inicializa el objeto 
		 */
		protected function init(e:Event):void
		{
			ApiHelper.init(this.stage, callbackFunction);
			
			autoReference = this;
			
			addChild(mainSprite);
			updateDebugSprite();
			
			new Input(mainSprite);
			
			addEventListener(Event.ENTER_FRAME, enterFrameEvent);
			
			physicalEnvironment_ = new PhysicalEnvironment(debugSprite, 5000, 5000);
			
			tooltip_ = OBO_ToolTip.createToolTip(this.stage, new Folks(), 0xfefefe, 0.9, "roundTip", 0x222222, 13);
		}
		
		public function createAvatar(userUuid:String):PhysicalAvatar
		{
			avatars[userUuid] = new Object();
			avatars[userUuid].instance = new PhysicalAvatar(physicalEnvironment_);
			
			requestInfoToServer(userUuid);
			
			return avatars[userUuid].instance;
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
				case "Player":
					setAvatarInfo(data.userUuid, data.Username, 0);
					break;
				case "PiecesByOwner":
					startAssetsLoad(data.userUuid, data.pieces);
					break;
			}
		}
		
		/**
		 * Establece la información del avatar
		 * @param	name
		 * @param	gender
		 */
		protected function setAvatarInfo(userUuid:String, name:String, gender:Boolean):void
		{
			avatars[userUuid].name  = name;
			avatars[userUuid].isMale  = gender;
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
			for each(var avatar:Object in avatars)
			{
				avatar.instance.update();
			}
			if (Input.isKeyReleased(9))
			{  debug = !debug; trace("debug = " + debug_); }
			
			Input.update();
		}
		
		/**
		 * Inicia la petición al servidor para obtener la información de las partes del avatar
		 */
		protected function requestInfoToServer(userUuid:String):void
		{
			ApiHelper.getPiecesByOwner(userUuid);
			ApiHelper.getPiecesByOwner(userUuid, "", true);
		}
		
		/**
		 * Lanza la carga de los gráficos del avatar
		 */
		protected function startAssetsLoad(userUuid:String, piecesInfo:Array):void
		{
			avatars[userUuid].instance.startAutoLoad(piecesInfo);
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