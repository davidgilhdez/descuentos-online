<?php

namespace ProductsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use ProductsBundle\Form\Type\AddProductType;

class ProductsController extends Controller
{
	
	
    public function addProductAction(Request $request)
    {
      $form = $this->createForm(new AddProductType());  
		$form->handleRequest($request);
      return $this->render('ProductsBundle:Products:add.html.twig',array('form' => $form->createView()));
    }
    
    
    
    public function editProductAction($id,Request $request)
    {
    	$form = $this->createForm(new AddProductType());  
		$form->handleRequest($request);
      return $this->render('ProductsBundle:Products:edit.html.twig',array('id'=>$id,'form' => $form->createView()));
        
    }
    
    
    
    public function showProductAction($product)
    {
        return $this->render('ProductsBundle:Products:show.html.twig',array('product'=>$product));
    }
    
    
    
    public function deleteProductAction($id)
    {
        return $this->render('ProductsBundle:Products:delete.html.twig',array('id'=>$id));
    }
    
    
    
    public function manageProductAction()
    {
        return $this->render('ProductsBundle:Products:manage.html.twig');
    }
}
