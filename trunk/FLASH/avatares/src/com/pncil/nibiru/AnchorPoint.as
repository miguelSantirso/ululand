package com.pncil.nibiru 
{
	
	/**
	* Estructura de datos que almacena la información de un punto de anclaje
	* @author Miguel Santirso
	*/
	public class AnchorPoint 
	{
		protected var x_:Number;
		protected var y_:Number;
		protected var lowerAngle_:Number = 0;
		protected var upperAngle_:Number = 0;
		
		/**
		 * Constructor de la clase
		 * @param	x Coordenada horizontal del punto de anclaje
		 * @param	y Coordenada vertical del punto de anclaje
		 * @param	lowerAngle Ángulo mínimo que admite el punto de anclaje
		 * @param	upperAngle Máximo ángulo del punto de anclaje
		 */
		public function AnchorPoint(x:Number, y:Number, lowerAngle:Number = 0, upperAngle:Number = 0) 
		{
			// Almacenar las variables que nos pasan como parámetros
			x_ = x;
			y_ = y;
			lowerAngle_ = lowerAngle;
			upperAngle_ = upperAngle;
		}
		
		public function get x():Number { return x_; }
		public function get y():Number { return y_; }
		public function get lowerAngle():Number { return lowerAngle_; }
		public function get upperAngle():Number { return upperAngle_; }
	}
	
}