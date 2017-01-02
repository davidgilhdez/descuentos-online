<?php

namespace tests\UsersBundle\UnitTests;

use UsersBundle\Entity\Pedido;
use UsersBundle\Entity\Linea_pedido;

class CalcularImporteTest extends \PHPUnit_Framework_TestCase
{

	public function testCalcularImporte(){
		
		$pedido = new Pedido();
		$linea1 = new Linea_pedido();
		$linea2 = new Linea_pedido();
	
		$linea1->setImporte(75);
		$linea2->setImporte(125);
	
		$pedido->addLineasPedido($linea1);
		$pedido->addLineasPedido($linea2);
		$this->assertEquals(200, $pedido->calcularImporte(),'El importe del pedido es 200 euros');
	}

}