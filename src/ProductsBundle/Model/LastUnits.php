<?php

namespace ProductsBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

class LastUnits
{

	private $om;
	
	public function __construct(ObjectManager $om){
	
		$this->om = $om;	
	}

	public function getLastUnits(){
	
		$query = $this->om->createQuery('SELECT p FROM ProductsBundle\Entity\Producto p WHERE p.cantidad <= 10');
		return $query->getResult();
	}

}