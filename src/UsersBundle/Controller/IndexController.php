<?php

namespace UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProductsBundle\Entity\Producto;




class IndexController extends Controller

/******************************   INDEX   ************************************************************/
{
    public function indexAction()
    {
    	
    	//obtengo los productos a la venta
    	
    	$productos = $this->getDoctrine()->getRepository('ProductsBundle:Producto')->findByVendiendo(true);
    	return $this->render('UsersBundle:Users:index.html.twig', array('productos'=>$productos));
    
    }
}