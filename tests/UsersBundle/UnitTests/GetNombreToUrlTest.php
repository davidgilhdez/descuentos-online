<?php

namespace tests\UsersBundle\UnitTests;

use ProductsBundle\Entity\Producto;

class GetNombreToUrlTest extends \PHPUnit_Framework_TestCase
{

	public function testGetNombreToUrl(){
		
		$producto = new Producto();
		
		$producto->setNombre('Nombre del producto');		
		
		$this->assertEquals('Nombre-del-producto', $producto->getNombretoUrl(),
		'El nombre del producto se ha convertido correctamente');
	}

}