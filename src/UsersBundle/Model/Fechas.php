<?php

namespace UsersBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

class Fechas
{

	private $om;
	
	public function __construct(ObjectManager $om){
	
		$this->om = $om;	
	}

	public function getPedidosProcesados(){
	
		$query = $this->om->createQuery("SELECT p FROM UsersBundle\Entity\Pedido p WHERE p.estado = 'Finalizado' 
		ORDER BY p.fechaprocesado DESC ");
		return $query->getResult();
	}
	
	public function getPedidosOrdenados($usuario){
	
		$query = $this->om->createQuery("SELECT p FROM UsersBundle\Entity\Pedido p WHERE p.usuario = $usuario 
		ORDER BY p.fecha DESC ");
		return $query->getResult();
	}

}