package com.pncil.nibiru 
{
	import Box2D.Collision.Shapes.b2PolygonDef;
	import Box2D.Dynamics.b2Body;
	import Box2D.Common.Math.b2Vec2;
	import Box2D.Dynamics.b2BodyDef;
	import com.pncil.physics.PhysicalEnvironment;
	import flash.events.Event;
	
	/**
	* Parte de un avatar sujeta a las físicas. Extiende la clase Part.
	* @author Miguel Santirso
	*/
	public class PhysicalPart extends Part
	{
		/**
		 * Cuerpo sujeto a las físicas
		 */
		protected var physicalBody_:b2Body;
		
		protected var initialPosition_:b2Vec2;
		/**
		 * Indica si el cuerpo será estático o dinámico
		 */
		protected var isFixed_:Boolean = false;
		
		/**
		 * Referencia al entorno de físicas.
		 */
		protected var physicalEnvironment_:PhysicalEnvironment;
		
		/**
		 * Constructor de la clase
		 * @param   shapeInfoUrl Ruta hasta el archivo de configuración de la forma de la parte (.xml)
		 * @param	physicalEnvironment Referencia al objeto que controla las físicas
		 * @param	fixed Si es true, la parte se creará como estática
		 */
		public function PhysicalPart(shapeInfoUrl:String, physicalEnvironment:PhysicalEnvironment, initialX:Number = 0, initialY:Number = 15, fixed:Boolean = false)
		{
			initialPosition_ = new b2Vec2(initialX, initialY);
			
			super(shapeInfoUrl);
			isFixed_ = fixed;
			physicalEnvironment_ = physicalEnvironment;
			
			/**
			 * Llama a la función adecuada cuando se completa la carga de la forma desde el xml
			 */
			eventDispatcher_.addEventListener(Part.SHAPE_LOADED, shapeLoadedEvent);
		}
		
		/**
		 * Actualiza la parte (básicamente, coloca el gráfico en la misma posición que el cuerpo físico)
		 */
		public function update():void
		{
			if (physicalBody_)
			{	
				var bodyAngle:Number = physicalBody_.GetAngle();
				sprite_.rotation = (bodyAngle * 180) / Math.PI;
				
				//Main.autoReference.debugSprite.graphics.moveTo(sprite_.x, sprite_.y);
				sprite_.x = physicalBody_.GetPosition().x;
				sprite_.y = physicalBody_.GetPosition().y;
			}
		}
		
		/**
		 * Inicializa el cuerpo físico a partir de la forma cargada del XML
		 */
		protected function initializeBodyFromShape():void
		{
			if (!vertices_)
			{
				throw new Error("ERROR en PhysicalPart::initializeBodyFromShape() > vertices_ no está definido");
			}
			else if (vertices_.length > 0)
			{
				// Inicializar las variables
				var bodyDef:b2BodyDef = new b2BodyDef();
				var polygonDef:b2PolygonDef = new b2PolygonDef();
				
				// Definir propiedades físicas de la forma
				polygonDef.friction = 0.3;
				polygonDef.density = 0.5;
				polygonDef.restitution = 0.1;
				
				// Recorrer el array de vértices, definiendo el polígono
				polygonDef.vertexCount = vertices_.length;
				for (var i:int = 0; i < vertices_.length; i++)
				{
					polygonDef.vertices[i].Set(vertices_[i].x, vertices_[i].y);
				}
				
				bodyDef.position.Set(initialPosition_.x, initialPosition_.y);
				
				// Crear el cuerpo en la factoría de cuerpos
				if (isFixed_)
				{
					physicalBody_ = physicalEnvironment_.world.CreateStaticBody(bodyDef);
				}
				else
				{
					physicalBody_ = physicalEnvironment_.world.CreateDynamicBody(bodyDef);
				}
				
				// Al ponerle a todas las partes del avatar el mismo índice, conseguimos que no colisionen entre sí
				// TODO: Este número debería ser único por cada avatar, para que los avatares sí colisionen entre sí cuando haya varios
				polygonDef.groupIndex = -69;
				
				// Darle las propiedades adecuadas al cuerpo a partir de la definición del polígono.
				physicalBody_.CreateShape(polygonDef);
				physicalBody_.SetMassFromShapes();
				
				physicalBody_.WakeUp();
			}
		}
		
		protected function shapeLoadedEvent(e:Event):void
		{
			initializeBodyFromShape();
		}
		
		public function get body():b2Body { return physicalBody_; }
		
	}
	
}