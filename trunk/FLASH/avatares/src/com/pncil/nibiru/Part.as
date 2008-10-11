package com.pncil.nibiru 
{
	import Box2D.Common.Math.b2Vec2;
	import flash.display.Bitmap;
	import flash.display.Sprite;
	import flash.events.EventDispatcher;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.events.Event;
	
	/**
	* Clase que representa una parte de un avatar
	* @author Miguel Santirso
	*/
	public class Part
	{
		/**
		 * Nombre del evento que indica que la forma ha sido ya cargada desde el archivo XML
		 */
		public static const SHAPE_LOADED:String = "shapeLoaded";
		
		/**
		 * Gráfico que representa gráficamente la parte del avatar
		 */
		protected var sprite_:Sprite = new Sprite();
		
		/**
		 * Vértices que dan la forma poligonal a la parte
		 */
		protected var vertices_:Array = new Array;
		/**
		 * Puntos de anclaje de la parte
		 */
		protected var anchorPoints_:Array = new Array;
		/**
		 * Esquina superior izquierda del rectángulo que delimita la forma de la parte.
		 */
		protected var topLeftCorner_:b2Vec2;
		/**
		 * Esquina inferior derecha del rectángulo que delimita la forma de la parte.
		 */
		protected var bottomRightCorner_:b2Vec2;
		
		/**
		 * Información de la forma de esta parte en XML
		 */
		protected var shapeInfoUrl_:String;
		
		/**
		 * Lanzador de eventos
		 */
		protected var eventDispatcher_:EventDispatcher = new EventDispatcher();
		
		/**
		 * Indica si la forma ya ha sido cargada
		 */
		protected var isLoaded_:Boolean = false;
		
		/**
		 * Sprite principal
		 */
		protected var mainSprite_:Sprite;
		
		/**
		 * Constructor de la clase
		 * @param shapeInfoUrl String ruta hasta el archivo de configuración de la forma de la parte (.xml)
		 */
		public function Part(shapeInfoUrl:String, mainSprite:Sprite=null) 
		{
			if (mainSprite)
				mainSprite_ = mainSprite;
			else
				mainSprite_ = AutoAvatar.autoReference.mainSprite;
			
			mainSprite_.addChild(sprite_);
			sprite_.mouseEnabled = true;
			
			shapeInfoUrl_ = shapeInfoUrl;
			
			loadShapeFromXml();
		}
		
		/**
		 * Realiza todas las operaciones necesarias para destruir el objeto
		 */
		public function destroy():void
		{
			if (mainSprite_.contains(sprite_))
				mainSprite_.removeChild(sprite_);
		}
		
		/**
		 * Función que carga la forma de la parte desde el archivo XML indicado en el constructor.
		 */
		protected function loadShapeFromXml():void
		{
			var fileLoader:URLLoader = new URLLoader;
			
			fileLoader.load(new URLRequest(shapeInfoUrl_));
			fileLoader.addEventListener(Event.COMPLETE, shapeInfoLoaded);
			
			function shapeInfoLoaded(e:Event):void
			{
				topLeftCorner_ = new b2Vec2();
				bottomRightCorner_ = new b2Vec2();
				
				var verticesXml:XMLList;
				var anchorPointsXml:XMLList;
				var xml:XML = new XML();
				
				// procesar el archivo xml
				xml = XML(e.target.data);
				verticesXml = xml.shape.vertex;
				anchorPointsXml = xml.anchorPoints.anchorPoint;
				
				// añadir todos los vértices descritos en el archivo xml
				for each(var vertex:XML in verticesXml)
				{
					// Los cuatro ifs siguientes sirven para definir la esquina superior izquierda y la inferior derecha
					if (topLeftCorner_.x == 0 || vertex.@x <= topLeftCorner_.x) topLeftCorner_.x = vertex.@x;
					if (topLeftCorner_.y == 0 || vertex.@y <= topLeftCorner_.y) topLeftCorner_.y = vertex.@y;
					if (bottomRightCorner_.x == 0 || vertex.@x >= bottomRightCorner_.x) bottomRightCorner_.x = vertex.@x;
					if (bottomRightCorner_.y == 0 || vertex.@y >= bottomRightCorner_.x) bottomRightCorner_.y = vertex.@y;
					
					// Añadir el vértice al array de vértices
					vertices_.push(new b2Vec2(vertex.@x, vertex.@y));
				}
				
				// añadir todos los puntos de anclaje definidos en el archivo xml
				for each(var anchorPoint:XML in anchorPointsXml)
				{
					// Obtener los ángulos máximo y mínimo del punto de anclaje
					var lowerAngle:Number = 0;
					var upperAngle:Number = 0;
					if (anchorPoint.hasOwnProperty("@lowerAngle")) lowerAngle = anchorPoint.@lowerAngle;
					if (anchorPoint.hasOwnProperty("@upperAngle")) upperAngle = anchorPoint.@upperAngle;
					
					// Añadir el punto de anclaje al array
					anchorPoints_.push(new AnchorPoint(anchorPoint.@x, anchorPoint.@y, lowerAngle, upperAngle));
				}
				
				eventDispatcher_.dispatchEvent(new Event(Part.SHAPE_LOADED));
				isLoaded_ = true;
			}
		}
		
		/**
		 * Modifica el sprite que representa gráficamente al objeto
		 * @todo dudoso, podría ser inútil
		 * @param	value Gráfico que se desea dar a la parte.
		 */
		public function setSprite(value:Sprite):void 
		{
			if(mainSprite_.contains(sprite_))
				mainSprite_.removeChild(sprite_);
			
			sprite_ = new Sprite();
			sprite_.addChild(value);
			/*value.width *= 0.5;
			value.height *= 0.5;
			value.x -= value.width * 0.5;
			value.y -= value.height * 0.5;*/
			mainSprite_.addChild(sprite_);
			trace(value + " (" + value.x + ", " + value.y + ")");
		}
		
		/**
		 * Modifica el sprite que representa gráficamente al objeto
		 * @param	value Gráfico que se desea dar a la parte.
		 */
		public function setBitmap(value:Bitmap):void 
		{
			if(mainSprite_.contains(sprite_))
				mainSprite_.removeChild(sprite_);
			
			sprite_ = new Sprite();
			sprite_.addChild(value);
			//value.width *= 0.5;
			//value.height *= 0.5;
			value.x -= value.width * 0.5;
			value.y -= value.height * 0.5;
			mainSprite_.addChild(sprite_);
		}
		
		public function get vertices():Array { return vertices_; }
		public function get anchorPoints():Array { return anchorPoints_; }
		public function get eventDispatcher():EventDispatcher { return eventDispatcher_; }
		public function get isLoaded():Boolean { return isLoaded_; }
		public function get sprite():Sprite { return sprite_; }
		public function get topLeftX():Number { return topLeftCorner_.x; }
		public function get topLeftY():Number { return topLeftCorner_.y; }
		public function get bottomRightX():Number { return bottomRightCorner_.x; }
		public function get bottomRightY():Number { return bottomRightCorner_.y; }
	}
	
}