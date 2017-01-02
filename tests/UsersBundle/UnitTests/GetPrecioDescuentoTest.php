<?php

namespace tests\UsersBundle\UnitTests;

use ProductsBundle\Entity\Producto;

class GetPrecioDescuentoTest extends \PHPUnit_Framework_TestCase
{

	public function testGetPrecioDescuento(){
		
		$producto = new Producto();
		
		$producto->setPrecio(100);
		$producto->setDescuento(10);		
		
		$this->assertEquals(90, $producto->getPrecio_descuento(),
		'El precio del producto con el descuento aplicado es de 90 euros');
	}

}