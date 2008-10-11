package com.pncil.nibiru 
{
	import Box2D.Common.Math.b2Vec2;
	import Box2D.Dynamics.b2Body;
	import Box2D.Dynamics.Joints.b2RevoluteJoint;
	import Box2D.Dynamics.Joints.b2RevoluteJointDef;
	import com.pncil.physics.PhysicalEnvironment;
	import flash.events.Event;
	
	/**
	* Estructura de datos que almacena la unión entre dos partes físicas
	* @author Miguel Santirso
	*/
	public class PartsUnion 
	{
		/**
		 * Identificador (dentro de la clase Avatar) de la parte A
		 */
		protected var partA_:PhysicalPart;
		/**
		 * Identificador (dentro de la clase Avatar) de la parte A
		 */
		protected var partB_:PhysicalPart;
		/**
		 * Identificador (dentro de la clase Part) de la parte A
		 */
		protected var anchorPointAId_:int;
		/**
		 * Identificador (dentro de la clase Part) de la parte A
		 */
		protected var anchorPointBId_:int;
		
		/**
		 * Referencia al objeto del entorno físico
		 */
		protected var physicalEnvironment_:PhysicalEnvironment;
		
		/**
		 * Cuenta las partes de la unión que han completado la carga. Cuando todas están creadas, crea la unión
		 */
		protected var partsLoaded_:int;
		
		/**
		 * Constructor de la clase
		 * @param	partA int Identificador para la parte A dentro del array de partes del avatar
		 * @param	anchorPointA int Identificador para el punto de anclaje de la parte A dentro del array de puntos de anclaje de la parte
		 * @param	partB int Identificador para la parte B dentro del array de partes del avatar
		 * @param	anchorPointB int Identificador para el punto de anclaje de la parte B dentro del array de puntos de anclaje de la parte
		 */
		public function PartsUnion(physicalPartA:PhysicalPart, anchorPointA:int, physicalPartB:PhysicalPart, anchorPointB:int, physicalEnvironment:PhysicalEnvironment)
		{
			// Guardamos las variables que nos pasan como parámetros
			partA_ = physicalPartA;
			partB_ = physicalPartB;
			anchorPointAId_ = anchorPointA;
			anchorPointBId_ = anchorPointB;
			physicalEnvironment_ = physicalEnvironment;
			
			// Comprobamos si las partes están ya cargadas
			partsLoaded_ = 2;
			if (!partA_.isLoaded)
			{
				// Esta parte no está cargada. Reducimos el número de partes cargadas y empezamos a esperar el momento en que termine
				partA_.eventDispatcher.addEventListener(Part.SHAPE_LOADED, shapeLoadedEvent);
				partsLoaded_--;
			}
			if (!partB_.isLoaded)
			{
				// Esta parte no está cargada. Reducimos el número de partes cargadas y empezamos a esperar el momento en que termine
				partB_.eventDispatcher.addEventListener(Part.SHAPE_LOADED, shapeLoadedEvent);
				partsLoaded_--;
			}
			
			// Si las dos partes que nos han pasado ya están cargadas, creamos directamente la unión
			if (partsLoaded_ == 2)
			{
				createJoint();
			}
		}
		
		/**
		 * Crea una unión entre las dos partes, centrándola en el anchorPoint indicado para cada una
		 */
		protected function createJoint():void
		{
				// Obtener los cuerpos físicos involucrados en la unión
				var bodyA:b2Body = (partA_ as PhysicalPart).body;
				var bodyB:b2Body = (partB_ as PhysicalPart).body;
				// Obtener las coordenadas de los puntos de anclaje (en coordenadas locales respecto a cada cuerpo)
				var anchorA:AnchorPoint = (partA_ as PhysicalPart).anchorPoints[anchorPointAId_];
				var anchorB:AnchorPoint = (partB_ as PhysicalPart).anchorPoints[anchorPointBId_];
				
				// Centrar los dos cuerpos físicos de forma que coincidan los dos puntos de anclaje en coordenadas de mundo
				bodyA.GetPosition().Set(anchorA.x, anchorA.y);
				bodyB.GetPosition().Set(anchorB.x, anchorB.y);
				
				// Crear la unión física entre los dos
				var joint:b2RevoluteJointDef = new b2RevoluteJointDef();
				joint.Initialize(bodyA, bodyB, new b2Vec2(0, 0));
				if (anchorA.lowerAngle != anchorA.upperAngle)
				{
					joint.enableLimit = true;
					joint.lowerAngle = anchorA.lowerAngle;
					joint.upperAngle = anchorA.upperAngle;
				}
				physicalEnvironment_.world.CreateJoint(joint);
		}
		
		protected function shapeLoadedEvent(e:Event):void
		{
			partsLoaded_++;
			if (partsLoaded_ == 2)
				createJoint();
		}
		
	}
	
}