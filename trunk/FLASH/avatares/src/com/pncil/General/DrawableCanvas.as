package com.pncil.General 
{
	import com.adobe.images.PNGEncoder;
	import flash.display.Bitmap;
	import flash.display.BitmapData;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.geom.Matrix;
	import flash.geom.Rectangle;
	import flash.utils.ByteArray;
	
	/**
	* Clase que representa a un lienzo sobre el que se puede dibujar.
	* @author Miguel Santirso
	*/
	public class DrawableCanvas extends Sprite
	{	
		/**
		 * Sprite al que se añadirá este objeto
		 */
		protected var mainSprite_:Sprite;
		
		/**
		 * Capa de fondo del lienzo (se dibujará en un sprite sobre esta capa)
		 */
		protected var backgroundLayer_:Sprite = new Sprite();;
		/**
		 * Capa de dibujo del lienzo (se sitúa sobre la capa de fondo)
		 */
		protected var drawableLayer_:Sprite = new Sprite();
		
		// Esquina superior izquierda del lienzo.
		protected var topLeftCornerX_:Number;
		protected var topLeftCornerY_:Number;
		
		// Esquina inferior derecha del lienzo.
		protected var bottomRightCornerX_:Number;
		protected var bottomRightCornerY_:Number;
		
		/**
		 * Nivel de zoom que se aplica al lienzo
		 */
		protected var zoom_:Number;
		
		/**
		 * Última coordenada horizontal a la que se ha movido el cursor de dibujado
		 */
		protected var lastX_:Number;
		/**
		 * Última coordenada vertical a la que se ha movido el cursor de dibujado
		 */
		protected var lastY_:Number;
		
		/**
		 * Longitud total de todos los trazos realizados en el lienzo
		 */
		protected var totalLength_:Number = 0;
		
		/**
		 * Flag que indica si se está dibujando sobre este lienzo
		 */
		protected var isDrawing_:Boolean = false;
		
		public function DrawableCanvas(mainSprite:Sprite) 
		{
			// Guardar el mainSprite y añadir este objeto al sprite principal (para que se dibuje en pantalla)
			mainSprite_ = mainSprite;
			mainSprite_.addChild(this);
			
			// Añadir las capas de fondo y dibujable al objeto
			this.addChild(backgroundLayer_);
			this.addChild(drawableLayer_);
			
			// Añadir los listeners de eventos que necesitamos
			this.stage.addEventListener(MouseEvent.MOUSE_DOWN, mouseDownEvent);
			this.stage.addEventListener(MouseEvent.MOUSE_MOVE, mouseMoveEvent);
			this.stage.addEventListener(MouseEvent.MOUSE_UP,   mouseUpEvent);
			this.mouseEnabled = true;
			lineStyle(2, 0x000000);
		}
		
		/**
		 * Realiza todas las operaciones necesarias para destruir el objeto
		 */
		public function destroy():void
		{
			if(mainSprite_.contains(this))
				mainSprite_.removeChild(this);
		}
		
		/**
		 * Establece los límites del lienzo. Fuera de estos límites no se dibujará nada
		 * @param	topLeftX Coordenada horizontal de la esquina superior izquierda del lienzo.
		 * @param	topLeftY Coordenada vertical de la esquina superior izquierda del lienzo.
		 * @param	bottomRightX Coordenada horizontal de la esquina inferior derecha del lienzo.
		 * @param	bottomRightY Coordenada vertical de la esquina inferior derecha del lienzo.
		 */
		public function setBounds(topLeftX:Number, topLeftY:Number, bottomRightX:Number, bottomRightY:Number):void
		{
			topLeftCornerX_ = topLeftX;
			topLeftCornerY_ = topLeftY;
			bottomRightCornerX_ = bottomRightX;
			bottomRightCornerY_ = bottomRightY;
			
			moveTo(topLeftX, topLeftY);
		}
		
		/**
		 * Coloca un gráfico en el condo del lienzo
		 * @param	bitmap gráfico que se situará en el fondo del lienzo
		 */
		public function setBackground(bitmap:Bitmap):void
		{
			bitmap.x = topLeftCornerX_;
			bitmap.y = topLeftCornerY_;
			backgroundLayer_ = new Sprite();
			this.addChildAt(backgroundLayer_, 0);
			backgroundLayer_.addChild(bitmap);
		}
		
		/**
		 * Retorna un ByteArray codificado en formato PNG
		 * @return zona dibujable codificada en formato PNG
		 */
		public function getPngEncoded():ByteArray
		{
			var bitmapData:BitmapData = new BitmapData(drawableWidth, drawableHeight, true, 0);
			bitmapData.draw(this, new Matrix(1, 0, 0, 1, -topLeftCornerX_, -topLeftCornerY_), null, null, new Rectangle(0, 0, width, height));
			
			return PNGEncoder.encode(bitmapData);
		}
		
		/**
		 * Modifica el estilo de la línea de dibujado
		 * @param	thickness
		 * @param	color
		 * @param	alpha
		 * @param	pixelHinting
		 * @param	scaleMode
		 * @param	caps
		 * @param	joints
		 * @param	miterLimit
		 */
		public function lineStyle(thickness:Number = NaN, color:uint = 0, alpha:Number = 1.0, pixelHinting:Boolean = false, scaleMode:String = "normal", caps:String = null, joints:String = null, miterLimit:Number = 3):void
		{
			drawableLayer_.graphics.lineStyle(thickness, color, alpha, pixelHinting, scaleMode, caps, joints, miterLimit);
		}
		
		/**
		 * Ancho de la zona dibujable
		 */
		public function get drawableWidth():Number { return bottomRightCornerX_ - topLeftCornerX_ ; }
		/**
		 * Alto de la zona dibujable
		 */
		public function get drawableHeight():Number { return bottomRightCornerY_ - topLeftCornerY_ ; }
		
		/**
		 * Retorna cierto si las coordenadas pasadas están dentro del lienzo
		 * @param	x Coordenada horizontal del punto hasta donde se quiere dibujar
		 * @param	y Coordenada vertical del punto hasta donde se quiere dibujar
		 * @return Cierto si las coordenadas pasadas están dentro del lienzo y falso si no.
		 */
		protected function isIn(x:Number, y:Number):Boolean
		{
			return (x >= topLeftCornerX_ && x <= bottomRightCornerX_ && y >= topLeftCornerY_ && y <= bottomRightCornerY_);
		}
		
		/**
		 * Mueve el punto de dibujado, teniendo en cuenta los límites del lienzo
		 * @param	x Coordenada horizontal del punto hasta donde se quiere dibujar
		 * @param	y Coordenada vertical del punto hasta donde se quiere dibujar
		 */
		protected function moveTo(x:Number, y:Number):void
		{
			if (isIn(x, y))
			{
				// Actualizar la posición almacenada del cursor de dibujado
				lastX_ = x; lastY_ = y;
				// Realizar el movimiento del cursor
				drawableLayer_.graphics.moveTo(x/zoom + (325 / zoom) * (zoom - 1), y/zoom + (200 / zoom) * (zoom - 1));
			}
		}
		
		/**
		 * Dibuja una línea hasta el punto indicado, teniendo en cuenta los límites del lienzo
		 * @param	x Coordenada horizontal del punto hasta donde se quiere dibujar
		 * @param	y Coordenada vertical del punto hasta donde se quiere dibujar
		 */
		protected function lineTo(x:Number, y:Number):void
		{
			if (isIn(x, y))
			{
				// Sumar la longitud del trazo a la distancia total dibujada
				recalculateDistanceTo(x, y);
				// Dibujar la línea
				drawableLayer_.graphics.lineTo(x/zoom + (325 / zoom) * (zoom - 1), y/zoom + (200 / zoom) * (zoom - 1));
			}
		}
		
		protected function recalculateDistanceTo(x:Number, y:Number):void
		{
			totalLength_ += Math.sqrt( Math.pow(x - lastX_ , 2) + Math.pow(y - lastY_, 2) ) / zoom;
			// Actualizar la posición almacenada del cursor de dibujado
			lastX_ = x; lastY_ = y;
		}
		
		protected function mouseDownEvent(e:MouseEvent):void
		{
			if (isIn(e.stageX, e.stageY))
			{
				isDrawing_ = true;
				this.moveTo(e.stageX, e.stageY);
				this.lineTo(e.stageX + 1, e.stageY + 1);
			}
		}
		protected function mouseMoveEvent(e:MouseEvent):void
		{
			if (isDrawing_) 
			{
				this.lineTo(e.stageX, e.stageY);
			}
		}
		protected function mouseUpEvent(e:MouseEvent):void
		{
			isDrawing_ = false;
		}
		
		/**
		 * Longitud total del trazo dibujado en el lienzo
		 */
		public function get totalLength():Number { return totalLength_; }
		public function get zoom():Number { return zoom_; }
		public function set zoom(value:Number):void 
		{
			zoom_ = value;
			this.scaleX = value;
			this.scaleY = value;
			this.x = -325 * (value - 1);
			this.y = -200 * (value - 1);
		}
		
	}
	
}