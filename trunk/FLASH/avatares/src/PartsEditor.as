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
	public class PartsEditor extends MovieClip
	{	
		protected static const ASSETS_URL:String = "http://pfc/uploads/UploadedPieces/";
		
		/**
		 * Objeto de tipo DrawablePart que servirá para dibujar las diferentes partes que se creen
		 */
		protected var drawablePart_:DrawablePart;
		/**
		 * Objeto que almacenará de forma ordenada toda la información de la pieza
		 */
		protected var partInfo_:Object;
		/**
		 * Api Key del avatar
		 */
		protected var avatarApiKey_:String;
		/**
		 * Total de créditos disponibles del avatar, sin contar lo que cuesta la pieza
		 */
		protected var avatarCredits_:Number = 0;
		/**
		 * Coste, en créditos de nibiru, de la pieza creada
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
		public function PartsEditor() 
		{
			// Inicializar el ApiHelper
			ApiHelper.init(this.stage, callbackFunction);
			
			avatarApiKey_ = this.root.loaderInfo.parameters.avatarApiKey;
			//avatarApiKey_ = "a30ue7108b66f";
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
				case "Avatar":
					//setAvatarName(data.Name);
					//setAvatarGender(data.Gender);
					break;
				case "PiecesByOwner":
					populateDataGrid(data.pieces);
					break;
				case "AvatarAvailableCredits":
					setAvailableCredits(data.avatarAvailableCredits);
					break;
			}
		}
		
		/**
		 * Inicia una petición al servidor para obtener los créditos totales del avatar
		 */
		protected function requestAvatarCredits():void
		{
			updateRemainingOperations(1);
			ApiHelper.getAvatarAvailableCredits(avatarApiKey_);
		}
		/**
		 * Inicia una petición al servidor para guardar todos los datos de la pieza
		 */
		protected function saveToServer():void
		{
			// indica si se está creando una pieza nueva o si se trata de una edición
			var isEdit:Boolean = partInfo_.id ? true : false;
			
			// @todo hasta que la api no informe de los envíos con éxito no se puede poner la pantalla de carga
			// updateRemainingOperations(1);
			ApiHelper.substractCredits(avatarApiKey_, pieceCost_);
			
			// codificar la imagen
			var encodedImage:String = Base64.encodeByteArray(drawablePart_.getCanvas().getPngEncoded())
			
			// Preparar las variables para enviar la información al servidor
			var variables:URLVariables = new URLVariables();
			if (isEdit) variables.pieceId = partInfo_.id; // indicar el id de la pieza en caso de que estemos editando
			variables.image = encodedImage;
			variables.name  = partInfo_.name;
			variables.description = partInfo_.description;
			variables.type = partInfo_.type;
			variables.price = pieceCost_;
			variables.avatarApiKey = avatarApiKey_;
			variables.apiSessionId = ApiHelper.getApiSessionId();
			
			// Preparar petición url al servidor
			var urlRequest:URLRequest = new URLRequest();
			urlRequest.url = 'http://pfc/api.php/avatarPiece/' + (isEdit ? 'edit' : 'add');
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
		 * Modifica el campo de créditos disponibles del avatar según la respuesta del servidor
		 * @param	credits
		 */
		protected function setAvailableCredits(credits:Number):void
		{
			avatarCredits_ = credits;
			avatarCredits.text = avatarCredits_.toString();
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
		 * Popula el catálogo de piezas con los datos que pide al servidor
		 */
		protected function startCatalog():void
		{
			updateRemainingOperations(1);
			piecesDataGrid.columns = ["id", "name", "type", "creator", "inUse"];
			ApiHelper.getPiecesByOwner(avatarApiKey_);
		}
		/**
		 * Popula el catálogo de piezas con los datos recibidos del servidor
		 * @param	dataArray
		 */
		protected function populateDataGrid(dataArray:Array):void
		{
			piecesDataGrid.dataProvider = new DataProvider(dataArray);
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
		protected function newPartClickedEvent(e:Event):void
		{
			newPart(typeComboBox.selectedItem.data);
		}
		protected function gotoCatalogClickedEvent(e:Event):void
		{
			gotoAndStop("piecesCatalog");
		}
		protected function backToStartEvent(e:Event):void
		{
			if(drawablePart_)
				drawablePart_.destroy();
			drawablePart_ = null;
			this.removeEventListener(Event.ENTER_FRAME, updatePieceCostEvent);
			gotoAndStop("mainMenu");
		}
		protected function gotoEditSelectedEvent(e:Event):void
		{
			editPart(piecesDataGrid.selectedItem);
		}
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
				remainingCredits.text = Math.round(avatarCredits_ - pieceCost_).toString();
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