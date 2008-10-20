package  
{
	import Box2D.Dynamics.Joints.b2RevoluteJointDef;
	import com.dynamicflash.util.Base64;
	import com.pncil.General.DrawableCanvas;
	import com.pncil.nibiru.DrawablePart;
	import flash.net.URLRequest;
	import flash.net.URLVariables;
	import flash.net.URLRequestMethod;
	import flash.net.URLLoader;
	import flash.display.Loader;
	import flash.system.LoaderContext;
	import flash.display.Bitmap;
	import flash.net.URLLoaderDataFormat;
	import flash.text.TextField;
	import flash.display.MovieClip;
	import flash.events.Event;
	import fl.events.ColorPickerEvent;
	import flash.events.MouseEvent;
	import ApiHelper;
	
	/**
	* Clase principal que maneja el comportamiento del editor de avatares físicos
	* @author Miguel Santirso
	*/
	public class SinglePartEditor extends MovieClip
	{	
		protected static const ASSETS_URL:String = "http://ululand/uploads/UploadedPieces/";
		
		/**
		 * Objeto de tipo DrawablePart que servirá para dibujar las diferentes partes que se creen
		 */
		protected var drawablePart_:DrawablePart;
		/**
		 * Objeto que almacenará de forma ordenada toda la información de la pieza
		 */
		protected var partInfo_:Object;
		/**
		 * Uuid del usuario propietario del avatar
		 */
		protected var userUuid_:String;
		/**
		 * Uuid de la pieza de avatar a editar
		 */
		protected var pieceUuid_:String;
		/**
		 * Tipo de la pieza de avatar a editar
		 */
		protected var pieceType_:String;
		/**
		 * Total de créditos disponibles del usuario, sin contar lo que cuesta la pieza
		 */
		protected var userCredits_:Number = 0;
		/**
		 * Coste, en créditos de ululand, de la pieza creada
		 */
		protected var pieceCost_:Number = 0;
		
		/**
		 * Pantalla de carga
		 */
		protected var loadingClip_:MovieClip;
		/**
		 * Número de operaciones en curso con la api
		 */
		protected var remainingOperations_:int = 0;
		
		/**
		 * Constructor de la clase
		 */
		public function SinglePartEditor() 
		{
			// Inicializar el ApiHelper
			ApiHelper.init(this.stage, callbackFunction);
			
			userUuid_ = this.root.loaderInfo.parameters.userUuid;
			//userUuid_ = "5005fd26-41a8-ce34-55ba-565e9d959c17";
			pieceUuid_ = this.root.loaderInfo.parameters.pieceUuid;
			pieceType_ = this.root.loaderInfo.parameters.pieceType;
			
			if (!pieceUuid_)
			{
				if (!pieceType_) throw new Error("Avatar piece type is missing");
				this.newPart(pieceType_);
			}
			else
			{
				updateRemainingOperations(1);
				ApiHelper.getAvatarPiece(pieceUuid_);
			}
		}
		
		
		/**
		 * Función necesaria para interactuar con la api
		 * @param	actionName
		 * @param	data
		 */
		public function callbackFunction(actionName:String, data:Object)
		{
			updateRemainingOperations(-1);
			switch(actionName)
			{
				case "AvatarPiece":
					startPieceEdition(data);
					break;
				case "PlayerAvailableCredits":
					setAvailableCredits(data.availableCredits);
					break;
			}
		}
		
		protected function startPieceEdition(data:Object)
		{
			// Cargar la información del objeto
			var partInfo:Object = new Object();
			partInfo.uuid = data.Uuid;
			partInfo.type = data.Type;
			partInfo.name = data.Name;
			partInfo.description = data.Description;
			partInfo.url = data.Url;
			pieceCost_ = data.Price;
			
			editPart(partInfo);
		}
		
		/**
		 * Inicia una petición al servidor para obtener los créditos totales del jugador
		 */
		protected function requestPlayerCredits():void
		{
			updateRemainingOperations(1);
			ApiHelper.getPlayerAvailableCredits(userUuid_);
		}
		/**
		 * Inicia una petición al servidor para guardar todos los datos de la pieza
		 */
		protected function saveToServer():void
		{
			// indica si se está creando una pieza nueva o si se trata de una edición
			var isEdit:Boolean = partInfo_.uuid ? true : false;
			
			// @todo hasta que la api no informe de los envíos con éxito no se puede poner la pantalla de carga
			// updateRemainingOperations(1);
			ApiHelper.substractPlayerCredits(userUuid_, pieceCost_);
			
			// codificar la imagen
			var encodedImage:String = Base64.encodeByteArray(drawablePart_.getCanvas().getPngEncoded())
			
			// Preparar las variables para enviar la información al servidor
			var variables:URLVariables = new URLVariables();
			if (isEdit) variables.pieceUuid = partInfo_.uuid; // indicar el id de la pieza en caso de que estemos editando
			variables.image = encodedImage;
			variables.name  = partInfo_.name;
			variables.description = partInfo_.description;
			variables.type = partInfo_.type;
			variables.price = pieceCost_;
			variables.userUuid = userUuid_;
			variables.apiSessionId = ApiHelper.getApiSessionId();
			
			// Preparar petición url al servidor
			var urlRequest:URLRequest = new URLRequest();
			urlRequest.url = 'http://ululand/api.php/avatarPiece/' + (isEdit ? 'edit' : 'add');
			urlRequest.method = URLRequestMethod.POST;
			urlRequest.data = variables;
			
			// Crear el cargador
			var loader:URLLoader = new URLLoader();
			loader.dataFormat = URLLoaderDataFormat.BINARY;
			
			// Realizar la petición
			loader.load(urlRequest);
			
			trace("Enviando pieza al servidor: " + urlRequest.url + "?" + variables.toString());
		}
		
		/**
		 * Modifica el campo de créditos disponibles del jugador según la respuesta del servidor
		 * @param	credits
		 */
		protected function setAvailableCredits(credits:Number):void
		{
			userCredits_ = credits;
			userCredits.text = userCredits_.toString();
		}
		
		/**
		 * Cambia al frame de edición de partes, creando una parte dibujable (DrawablePart) del tipo pasado como parámetro.
		 * @param	type tipo de la parte
		 */
		protected function newPart(type:String):void
		{
			// Reiniciar la información del objeto
			partInfo_ = new Object();
			partInfo_.type = type;
			partInfo_.name = "Nueva pieza";
			partInfo_.description = "Descripción de la pieza nueva";
			pieceCost_ = 0;
			
			// Cargar la parte dibujable y situarla en el centro de la pantalla
			drawablePart_ = new DrawablePart(ASSETS_URL + "shapes/" + partInfo_.type + ".xml", this);
			drawablePart_.setPosition(325, 200);
			
			gotoAndStop("editMenu");
		}
		/**
		 * Cambia al frame de edición de partes, creando una parte dibujable (DrawablePart) del tipo pasado como parámetro.
		 * @param	type tipo de la parte
		 */
		protected function editPart(partInfo:Object):void
		{
			function pieceGraphicLoaded(e:Event):void
			{
				var bitmap:Bitmap = new Bitmap(e.target.content.bitmapData.clone());
				drawablePart_.getCanvas().setBackground(bitmap);
				updateRemainingOperations( -1);
			}
			
			// Tomar la información del objeto de los datos del catálogo
			partInfo_ = new Object();
			partInfo_ = partInfo;
			
			// Cargar la parte dibujable y situarla en el centro de la pantalla
			drawablePart_ = new DrawablePart(ASSETS_URL + "shapes/" + partInfo_.type + ".xml", this);
			drawablePart_.setPosition(325, 200);
			
			updateRemainingOperations(1);
			var loader:Loader = new Loader();
			loader.load(new URLRequest(ASSETS_URL + partInfo_.url + "?nocache=" + Math.random() ), new LoaderContext(true) ); // lo de nocache hace falta para evitar que cargue el gráfico de la caché
			loader.contentLoaderInfo.addEventListener(Event.INIT, pieceGraphicLoaded );
			
			gotoAndStop("editMenu");
		}
		
		/**
		 * Actualiza el estado de las operaciones pendientes con la api
		 * @param	change Cambio en el número de operaciones pendientes. Un número negativo indica operaciones completadas y un número mayor que cero, indica nuevas operaciones pendientes
		 */
		protected function updateRemainingOperations(change:int):void
		{
			// Aplicar el cambio en el número de operaciones pendientes
			remainingOperations_ += change;
			
			// Si aún quedan tareas pendientes
			if (remainingOperations_ > 0)
			{
				// Mostrar la pantalla de carga, si es necesario
				if (loadingClip_ == null || !contains(loadingClip_))
				{
					loadingClip_ = new LoadingClip();
					loadingClip_.x = 325;
					loadingClip_.y = 200;
					this.addChild(loadingClip_);
				}
				// Modificar el texto que indica el número de operaciones restantes
				loadingClip_.remainingOperations.text = "Operaciones restantes: " + remainingOperations_.toString();
			}
			else // no quedan operaciones por realizar
			{
				// Si es necesario, quitar la pantalla de carga
				if (contains(loadingClip_))
				{
					this.removeChild(loadingClip_);
					loadingClip_ = null;
				}
				
			}
		}
		
		//////////////////////////////////////////////////
		// LISTENERS DE LOS BOTONES DE NAVEGACIÓN DEL INTERFAZ
		protected function backToEditEvent(e:Event):void
		{
			gotoAndStop("editMenu");
		}
		protected function gotoConfirmEvent(e:Event):void
		{
			this.removeEventListener(Event.ENTER_FRAME, updatePieceCostEvent);
			drawablePart_.zoom = 1;
			gotoAndStop("confirmMenu");
		}
		protected function gotoSaveEvent(e:Event):void
		{
			// Recoger la información del formulario
			partInfo_.name = nameInput.text;
			partInfo_.description = descriptionInput.text;
			
			this.saveToServer();
			drawablePart_.destroy();
			drawablePart_ = null;
			gotoAndStop("saveMenu");
		}
		protected function updatePieceCostEvent(e:Event):void
		{
			pieceCost_ = Math.round(drawablePart_.getCanvas().totalLength * 0.5);
			if(pieceCost)
				pieceCost.text = pieceCost_.toString();
			if(remainingCredits)
				remainingCredits.text = Math.round(userCredits_ - pieceCost_).toString();
		}
		protected function updateZoomEvent(e:Event):void
		{
			drawablePart_.zoom = zoomSelector.value;
		}
		//////////////////////////////////////////////////
		// LISTENERS DE LOS BOTONES DE LA INTERFAZ DEL EDITOR
		protected function updateLineStyleEvent(e:Event):void
		{
			drawablePart_.getCanvas().lineStyle(thicknessSelector.value, colorPicker.selectedColor);
		}
	}
	
}