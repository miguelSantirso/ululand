package com.pncil.physics 
{
	
	import Box2D.Collision.b2AABB;
	import Box2D.Collision.Shapes.b2PolygonDef;
	import Box2D.Collision.Shapes.b2Shape;
	import Box2D.Common.Math.b2Vec2;
	import Box2D.Dynamics.b2Body;
	import Box2D.Dynamics.b2BodyDef;
	import Box2D.Dynamics.b2DebugDraw;
	import Box2D.Dynamics.b2World;
	import Box2D.Dynamics.Joints.b2MouseJoint;
	import Box2D.Dynamics.Joints.b2MouseJointDef;
	import com.pncil.General.Input;
	import flash.display.Sprite;
	
	/**
	* Clase que inicializa y controla todo el funcionamiento de las físicas, usando la librería Box2D
	* @author Miguel Santirso
	*/
	public class PhysicalEnvironment 
	{
		/**
		 * Instancia de la clase b2World, que controla todas las físicas.
		 */
		protected var physicalWorld_:b2World;
		
		/**
		 * Sprite donde se realizará el dibujado de debug
		 */
		protected var debugSprite_:Sprite;
		/**
		 * Variable de configuración del mundo físico. Cuanto mayor sea este valor, mejor será la simulación.
		 */
		protected var worldConfigIterations_:int = 10;
		/**
		 * Variable de configuración del mundo físico. Cuanto mayor sea este valor, mejor será el rendimiento.
		 */
		protected var worldConfigTimeStep_:Number = 1 / 30;
		/**
		 * Escala del mundo físico. Este valor dividirá a todas las dimensiones de los objetos para escalarlos si es necesario.
		 */
		protected var worldConfigPhysicalScale_:Number = 1;
		/**
		 * Ancho y alto del mundo físico divididos por la mitad.
		 */
		protected var worldConfigSemiDimensions_:b2Vec2 = new b2Vec2();
		
		/**
		 * Joint que se usa para arrastrar objetos físicos con el ratón
		 */
		protected var mouseJoint_:b2MouseJoint = null;
		
		/**
		 * Coordenada x del ratón en el mundo
		 */
		static public var mouseXWorld:Number;
		/**
		 * Coordenada y del ratón en el mundo
		 */
		static public var mouseYWorld:Number;
		
		
		/**
		 * Constructor de la clase
		 * 
		 * @param	sprite Sprite Sprite donde se aplicará el dibujado de debug
		 * @param	semiWidth int Ancho del mundo físico dividido por 2
		 * @param	semiHeight int Alto del mundo físico dividido por 2
		 * @param	scale Number Escala del mundo físico. Este valor dividirá a todas las dimensiones de los objetos para escalarlos si es necesario.
		 * @param	iterations int Variable de configuración del mundo físico. Cuanto mayor sea este valor, mejor será la simulación.
		 * @param	timeStep Number Variable de configuración del mundo físico. Cuanto mayor sea este valor, mejor será el rendimiento.
		 */
		public function PhysicalEnvironment(sprite:Sprite, semiWidth:int, semiHeight:int, scale:Number = 1, iterations:int = 10, timeStep:Number = 1/5) 
		{
			debugSprite_ = sprite;
			worldConfigSemiDimensions_.Set(semiWidth, semiHeight);
			worldConfigPhysicalScale_ = scale;
			worldConfigIterations_ = iterations;
			worldConfigTimeStep_ = timeStep;
			
			initializeWorld();
			initializeDebugDraw();
		}
		
		/**
		 * Actualiza el mundo físico
		 */
		public function update():void
		{	
			mouseXWorld = Input.mouseX;
			mouseYWorld = Input.mouseY;
			
			updateMouseDrag();
			
			// Hacer que la simulación avance un paso
			physicalWorld_.Step(worldConfigTimeStep_, worldConfigIterations_);
		}
		
		/**
		 * Gestiona el sistema de arrastrar objetos con el ratón.
		 */
		public function updateMouseDrag():void
		{
			if (Input.mouseDown && !mouseJoint_){
				
				var body:b2Body = getBodyAtMouse();
				
				if (body)
				{
					var md:b2MouseJointDef = new b2MouseJointDef();
					md.body1 = physicalWorld_.m_groundBody;
					md.body2 = body;
					md.target.Set(PhysicalEnvironment.mouseXWorld, PhysicalEnvironment.mouseYWorld);
					md.maxForce = 300.0 * body.m_mass;
					md.timeStep = worldConfigTimeStep_;
					mouseJoint_ = physicalWorld_.CreateJoint(md) as b2MouseJoint;
					body.WakeUp();
				}
			}
			
			
			// mouse release
			if (!Input.mouseDown){
				if (mouseJoint_)
				{
					physicalWorld_.DestroyJoint(mouseJoint_);
					mouseJoint_ = null;
				}
			}
			
			
			// mouse move
			if (mouseJoint_)
			{
				var p2:b2Vec2 = new b2Vec2(mouseXWorld, mouseYWorld);
				mouseJoint_.SetTarget(p2);
			}
		}
		
		protected function getBodyAtMouse(includeStatic:Boolean = false):b2Body
		{
			// Make a small box.
			/*var mousePVec.Set(mouseXWorld, mouseYWorld);*/
			var aabb:b2AABB = new b2AABB();
			aabb.lowerBound.Set(mouseXWorld - 1000.001, mouseXWorld - 1000.001);
			aabb.upperBound.Set(mouseXWorld + 1000.001, mouseXWorld + 1000.001);
			
			// Query the world for overlapping shapes.
			var k_maxCount:int = 10;
			var shapes:Array = new Array();
			var count:int = physicalWorld_.Query(aabb, shapes, k_maxCount);
			var body:b2Body = null;
			for (var i:int = 0; i < count; ++i)
			{
				if (shapes[i].m_body.IsStatic() == false || includeStatic)
				{
					var tShape:b2Shape = shapes[i] as b2Shape;
					var inside:Boolean = tShape.TestPoint(tShape.m_body.GetXForm(), new b2Vec2(mouseXWorld, mouseYWorld));
					if (inside)
					{
						body = tShape.m_body;
						break;
					}
				}
			}
			return body;
		}
		
		/**
		 * Crea automáticamente unos límites físicos (con cajas estáticas) en los bordes de la pantalla
		 */
		public function createScreenBounds(windowWidth:int, windowHeight:int):void
		{
			// Create border of boxes
			var shapeDefinition:b2PolygonDef = new b2PolygonDef();
			var bodyDefinition:b2BodyDef = new b2BodyDef();
			var body:b2Body;
			
			// Izquierda
			bodyDefinition.position.Set(6 / worldConfigPhysicalScale_, windowHeight/2);
			shapeDefinition.SetAsBox(6 / worldConfigPhysicalScale_, windowHeight);
			body = physicalWorld_.CreateStaticBody(bodyDefinition);
			body.CreateShape(shapeDefinition);
			body.SetMassFromShapes();
			// Derecha
			bodyDefinition.position.Set(windowWidth - 6 / worldConfigPhysicalScale_, windowHeight/2);
			body = physicalWorld_.CreateStaticBody(bodyDefinition);
			body.CreateShape(shapeDefinition);
			body.SetMassFromShapes();
			
			// Techo
			bodyDefinition.position.Set(windowWidth/2, 6 / worldConfigPhysicalScale_);
			shapeDefinition.SetAsBox(windowWidth, 6 / worldConfigPhysicalScale_);
			body = physicalWorld_.CreateStaticBody(bodyDefinition);
			body.CreateShape(shapeDefinition);
			body.SetMassFromShapes();
			// Suelo
			bodyDefinition.position.Set(windowWidth/2, windowHeight - 6 / worldConfigPhysicalScale_);
			body = physicalWorld_.CreateStaticBody(bodyDefinition);
			body.CreateShape(shapeDefinition);
			body.SetMassFromShapes();
		}
		
		/**
		 * Inicializar la instancia del objeto de tipo b2World
		 */
		protected function initializeWorld():void
		{
			// Definir los límites del mundo
			var worldAABB:b2AABB = new b2AABB();
			worldAABB.lowerBound.Set(-worldConfigSemiDimensions_.x/worldConfigPhysicalScale_, -worldConfigSemiDimensions_.y/worldConfigPhysicalScale_);
			worldAABB.upperBound.Set(worldConfigSemiDimensions_.x/worldConfigPhysicalScale_, worldConfigSemiDimensions_.y/worldConfigPhysicalScale_);
			
			// Definir el vector de la gravedad
			var gravity:b2Vec2 = new b2Vec2(0.0, 10.0);
			
			// Permitir a los cuerpos que pasen al estado sleep
			var doSleep:Boolean = true;
			
			// Construir la instancia del objeto mundo
			physicalWorld_ = new b2World(worldAABB, gravity, doSleep);
		}
		
		/**
		 * Inicializar el dibujado de debug sobre la instancia del objeto b2World (que debería haber sido creado previamente, llamando a initializeWorld())
		 */
		protected function initializeDebugDraw():void
		{
			if (physicalWorld_)
			{
				// Inicializar el dibujado de debug
				var debugDraw:b2DebugDraw = new b2DebugDraw();
				
				// Configurar el dibujado de debug
				debugDraw.m_sprite = debugSprite_;
				debugDraw.m_drawScale = worldConfigPhysicalScale_;
				debugDraw.m_fillAlpha = 0.3;
				debugDraw.m_lineThickness = 1.0;
				debugDraw.m_drawFlags = b2DebugDraw.e_shapeBit | b2DebugDraw.e_jointBit;
				physicalWorld_.SetDebugDraw(debugDraw);
			}
			else
			{
				throw new Error("ERROR en PhysicalEnvironment::initializeDebugDraw() > Se ha llamado a initializeDebugDraw() y physicalWorld_ no estaba definido. Debe crearse el mundo físico antes de intentar inicializar el modo de Debug");
			}
		}
		
		public function get world():b2World { return physicalWorld_; }
	}
	
}