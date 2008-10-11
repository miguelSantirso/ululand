package com.pncil.nibiru 
{
	import Box2D.Common.Math.b2Vec2;
	import Box2D.Dynamics.b2Body;
	import Box2D.Dynamics.Joints.b2RevoluteJointDef;
	import com.pncil.physics.PhysicalEnvironment;
	import flash.display.Bitmap;
	import flash.events.Event;
	import flash.display.Loader;
	import flash.net.URLRequest;
	import flash.system.LoaderContext;
	
	/**
	* Clase que representa los avatares personalizables de nibiru
	* @author Miguel Santirso
	*/
	public class PhysicalAvatar 
	{
		/**
		 * Array de partes físicas (PhysicalPart)
		 */
		protected var parts_:Array = new Array();
		/**
		 * Array de uniones (PartsUnion)
		 */
		protected var unions_:Array = new Array();
		/**
		 * Referencia a la instancia del entorno físico
		 */
		protected var physicalEnvironment_:PhysicalEnvironment;
		
		/**
		 * Constructor de la clase
		 * @param	physicalEnvironment Referencia a la instancia del entorno físico
		 */
		public function PhysicalAvatar(physicalEnvironment:PhysicalEnvironment) 
		{
			physicalEnvironment_ = physicalEnvironment;
			init();
		}
		
		/**
		 * Inicia automaticamente la carga de los gráficos que componen el avatar
		 * @param	assetsData
		 */
		public function startAutoLoad(assetsData:Array):void
		{
			for each(var piece:Object in assetsData)
			{
				var loader:Loader = new Loader();
				// lo de nocache es para evitar que las imagenes se cacheen en el cliente
				loader.load(new URLRequest(AutoAvatar.ASSETS_URL + piece.url + "?nocache=" + Math.random()), new LoaderContext(true));
				switch(piece.type)
				{
					case "head":
						loader.contentLoaderInfo.addEventListener(Event.INIT, changeHeadSprite);
					break;
					case "body":
						loader.contentLoaderInfo.addEventListener(Event.INIT, changeBodySprite);
					break;
					case "arm":
						loader.contentLoaderInfo.addEventListener(Event.INIT, changeRightArmSprite);
						loader.contentLoaderInfo.addEventListener(Event.INIT, changeLeftArmSprite);
					break;
					case "leg":
						loader.contentLoaderInfo.addEventListener(Event.INIT, changeRightLegSprite);
						loader.contentLoaderInfo.addEventListener(Event.INIT, changeLeftLegSprite);
					break;
				}
			}
		}
		
		protected function changeHeadSprite(e:Event):void
		{
			changePartSpriteFromEvent(e, 0);
		}
		protected function changeBodySprite(e:Event):void
		{
			changePartSpriteFromEvent(e, 1);
		}
		protected function changeRightArmSprite(e:Event):void
		{
			changePartSpriteFromEvent(e, 2);
		}
		protected function changeLeftArmSprite(e:Event):void
		{
			changePartSpriteFromEvent(e, 3);
		}
		protected function changeRightLegSprite(e:Event):void
		{
			changePartSpriteFromEvent(e, 4);
		}
		protected function changeLeftLegSprite(e:Event):void
		{
			changePartSpriteFromEvent(e, 5);
		}
		protected function changePartSpriteFromEvent(e:Event, part:Number):void
		{
			var bitmap:Bitmap = new Bitmap(e.target.content.bitmapData.clone());
			parts[part].setBitmap(bitmap);
		}
		
		/**
		 * Inicializa el avatar físico
		 */
		protected function init():void
		{
			// VERSIÓN INICIAL: Cargamos los archivos XML a mano
			parts_.push(new PhysicalPart(AutoAvatar.SHAPES_URL + "head.xml", physicalEnvironment_)); // parts_[0]
			parts_.push(new PhysicalPart(AutoAvatar.SHAPES_URL + "body.xml", physicalEnvironment_)); // parts_[1]
			parts_.push(new PhysicalPart(AutoAvatar.SHAPES_URL + "arm.xml", physicalEnvironment_));  // parts_[2]
			parts_.push(new PhysicalPart(AutoAvatar.SHAPES_URL + "arm.xml", physicalEnvironment_));  // parts_[3]
			parts_.push(new PhysicalPart(AutoAvatar.SHAPES_URL + "leg.xml", physicalEnvironment_));  // parts_[4]
			parts_.push(new PhysicalPart(AutoAvatar.SHAPES_URL + "leg.xml", physicalEnvironment_));  // parts_[5]
			
			// VERSIÓN INICIAL: Creamos las uniones a mano
			unions_.push(new PartsUnion(parts_[1], 0, parts_[0], 1, physicalEnvironment_));
			unions_.push(new PartsUnion(parts_[1], 1, parts_[2], 0, physicalEnvironment_));
			unions_.push(new PartsUnion(parts_[1], 2, parts_[3], 0, physicalEnvironment_));
			unions_.push(new PartsUnion(parts_[1], 3, parts_[4], 0, physicalEnvironment_));
			unions_.push(new PartsUnion(parts_[1], 4, parts_[5], 0, physicalEnvironment_));
			
		}
		
		/**
		 * Actualiza el avatar junto con todas sus partes
		 */
		public function update():void
		{
			// Actualizar todas las partes del avatar
			for each(var part:PhysicalPart in parts_)
			{
				part.update();
			}
		}
		
		/**
		 * Engancha el avatar a cierto cuerpo en las coordenadas dadas
		 * @param	body
		 * @param	x
		 * @param	y
		 */
		public function pinTo(part:PhysicalPart, anchorPointId:int):void
		{
			new PartsUnion(parts_[0], 0, part, anchorPointId, physicalEnvironment_);
		}
		
		/**
		 * Se engancha, automaticamente, al punto indicado en los parámetros. Se usará la cabeza como punto de anclaje
		 * @param	x
		 * @param	y
		 */
		public function autoPinTo(x:Number, y:Number):void
		{
			var wall_:PhysicalPart;
			wall_   = new PhysicalPart(AutoAvatar.SHAPES_URL + "fixedTriangle.xml", physicalEnvironment_, x, y, true);
			
			pinTo(wall_, 0);
		}
		
		public function get parts():Array { return parts_; }
	}

}