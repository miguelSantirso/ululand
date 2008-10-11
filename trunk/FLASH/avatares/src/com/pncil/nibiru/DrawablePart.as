package com.pncil.nibiru 
{
	import Box2D.Common.Math.b2Vec2;
	import com.pncil.General.DrawableCanvas;
	import flash.display.Sprite;
	import flash.events.Event;
	
	/**
	* Parte editable de un avatar. Extiende la clase Part.
	* @author Miguel Santirso
	*/
	public class DrawablePart extends Part
	{
		/**
		 * Lienzo dibujable.
		 */
		protected var partCanvas_:DrawableCanvas;
		
		/**
		 * Multiplicador del tamaño de la parte dibujable
		 */
		protected var zoom_:Number = 1.0;
		
		/**
		 * Constructor de la clase
		 * @param   shapeInfoUrl Ruta hasta el archivo de configuración de la forma de la parte (.xml)
		 */
		public function DrawablePart(shapeInfoUrl:String, mainSprite:Sprite)
		{
			super(shapeInfoUrl, mainSprite);
			partCanvas_ = new DrawableCanvas(mainSprite);
			
			this.eventDispatcher.addEventListener(Part.SHAPE_LOADED, shapeLoadedEvent);
		}
		
		/**
		 * Realiza todas las operaciones necesarias para destruir el objeto
		 */
		public override function destroy():void
		{
			partCanvas_.destroy();
			super.destroy();
		}
		
		public function setPosition(x:Number, y:Number):void
		{
			sprite_.x = x;
			sprite_.y = y;
		}
		
		public function getCanvas():DrawableCanvas
		{
			return partCanvas_;
			sprite_.graphics.clear();
		}
		
		/**
		 * Inicializa el objeto una vez se ha cargado la forma desde el archivo xml
		 */
		protected function initialize():void
		{
			sprite_.graphics.clear();
			
			sprite_.graphics.lineStyle(1, 0xAA0088, 0.2);
			sprite_.graphics.drawRect(topLeftX*zoom, topLeftY*zoom, (bottomRightX - topLeftX)*zoom, (bottomRightY - topLeftY)*zoom);
			sprite_.graphics.lineStyle(1, 0x000000, 0.6);
			var originVertex:b2Vec2 = new b2Vec2(vertices_[0].x*zoom, vertices_[0].y*zoom);
			sprite_.graphics.moveTo(originVertex.x, originVertex.y);
			for each (var vertex:b2Vec2 in vertices_)
			{
				sprite_.graphics.lineTo(vertex.x*zoom, vertex.y*zoom);
			}
			sprite_.graphics.lineTo(originVertex.x, originVertex.y);
			partCanvas_.zoom = zoom_;
			partCanvas_.setBounds(topLeftX*zoom + sprite_.x, topLeftY*zoom + sprite_.y, bottomRightX*zoom + sprite_.x, bottomRightY*zoom + sprite_.y);
		}
		
		protected function shapeLoadedEvent(e:Event):void
		{
			initialize();
		}
		
		public function get x():Number { return sprite_.x; }
		public function get y():Number { return sprite_.y; }
		public function get zoom():Number { return zoom_; }
		public function set zoom(value:Number):void 
		{
			zoom_ = value;
			initialize();
		}
	}
	
}