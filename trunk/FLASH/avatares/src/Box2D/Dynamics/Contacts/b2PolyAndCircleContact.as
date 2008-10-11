/*
* Copyright (c) 2006-2007 Erin Catto http://www.gphysics.com
*
* This software is provided 'as-is', without any express or implied
* warranty.  In no event will the authors be held liable for any damages
* arising from the use of this software.
* Permission is granted to anyone to use this software for any purpose,
* including commercial applications, and to alter it and redistribute it
* freely, subject to the following restrictions:
* 1. The origin of this software must not be misrepresented; you must not
* claim that you wrote the original software. If you use this software
* in a product, an acknowledgment in the product documentation would be
* appreciated but is not required.
* 2. Altered source versions must be plainly marked as such, and must not be
* misrepresented as being the original software.
* 3. This notice may not be removed or altered from any source distribution.
*/

package Box2D.Dynamics.Contacts{


import Box2D.Collision.Shapes.*
import Box2D.Collision.*
import Box2D.Dynamics.*
import Box2D.Common.*
import Box2D.Common.Math.*


public class b2PolyAndCircleContact extends b2Contact{
	
	static public function Create(shape1:b2Shape, shape2:b2Shape, allocator:*):b2Contact{
		return new b2PolyAndCircleContact(shape1, shape2);
	}
	static public function Destroy(contact:b2Contact, allocator:*): void{
		//
		//b2Assert(contact.m_shape1.m_body.m_contactList != contact.m_node1);
		//b2Assert(contact.m_shape1.m_body.m_contactList != contact.m_node2);
		//b2Assert(contact.m_shape2.m_body.m_contactList != contact.m_node1);
		//b2Assert(contact.m_shape2.m_body.m_contactList != contact.m_node2);
	}

	public function b2PolyAndCircleContact(shape1:b2Shape, shape2:b2Shape){
		super(shape1, shape2);
		
		m_manifold = m_manifolds[0];
		
		b2Settings.b2Assert(m_shape1.m_type == b2Shape.e_polygonShape);
		b2Settings.b2Assert(m_shape2.m_type == b2Shape.e_circleShape);
		m_manifold.pointCount = 0;
		m_manifold.points[0].normalForce = 0.0;
		m_manifold.points[0].tangentForce = 0.0;
	}
	//~b2PolyAndCircleContact() {}

	//
	static private var s_evalCP:b2ContactPoint = new b2ContactPoint();
	//
	public override function Evaluate(listener:b2ContactListener): void{
		
		var b1:b2Body = m_shape1.GetBody();
		var b2:b2Body = m_shape2.GetBody();
		
		//b2Manifold m0;
		//memcpy(&m0, &m_manifold, sizeof(b2Manifold));
		// TODO: make sure this is completely necessary
		m0.Set(m_manifold);
		
		b2Collision.b2CollidePolygonAndCircle(m_manifold, m_shape1 as b2PolygonShape, b1.m_xf, m_shape2 as b2CircleShape, b2.m_xf);
		
		if (m_manifold.pointCount > 0)
		{
			m_manifoldCount = 1;
			if (m0.pointCount == 0)
			{
				m_manifold.points[0].id.features.flip |= b2Collision.b2_newPoint;
			}
			else
			{
				m_manifold.points[0].id.features.flip &= ~b2Collision.b2_newPoint;
			}
		}
		else
		{
			m_manifoldCount = 0;
			if (m0.pointCount > 0 && listener)
			{
				var cp:b2ContactPoint = s_evalCP;
				cp.shape1 = m_shape1;
				cp.shape2 = m_shape2;
				cp.normal.SetV(m0.normal);
				//cp.position = b2Mul(b1->m_xf, m0.points[0].localPoint1);
				var tMat:b2Mat22 = b1.m_xf.R;
				var tVec:b2Vec2 = m0.points[0].localPoint1;
				cp.position.x = b1.m_xf.position.x + (tMat.col1.x * tVec.x + tMat.col2.x * tVec.y);
				cp.position.y = b1.m_xf.position.y + (tMat.col1.y * tVec.x + tMat.col2.y * tVec.y);
				cp.separation = m0.points[0].separation;
				cp.normalForce = m0.points[0].normalForce;
				cp.tangentForce = m0.points[0].tangentForce;
				cp.id = m0.points[0].id;
				listener.Remove(cp);
			}
		}
	}
	
	public override function GetManifolds():Array
	{
		return m_manifolds;
	}

	private var m_manifolds:Array = [new b2Manifold()];
	public var m_manifold:b2Manifold;
	private var m0:b2Manifold = new b2Manifold();
	
}

}