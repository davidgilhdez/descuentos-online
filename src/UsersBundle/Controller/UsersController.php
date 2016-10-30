<?php

namespace UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use UsersBundle\Form\Type\LoginType;
use UsersBundle\Form\Type\RegisterType;
use UsersBundle\Form\Type\EditUserType;



class UsersController extends Controller
{
    public function indexAction(Request $request)
    {
    	$session = $request->getSession();
    	if($session->has('username')){
    		return $this->render('UsersBundle:Users:index.html.twig');
    	}
    	else{
		$form = $this->createForm(new LoginType());  
		$form->handleRequest($request);  
		
		
		return $this->render('UsersBundle:Users:index.html.twig',array('form' => $form->createView()));	
    	}
        
    }
    
    
    
    
    public function registerAction(Request $request)
    {
 
    	$form = $this->createForm(new RegisterType());  
		$form->handleRequest($request);
      return $this->render('UsersBundle:Users:register.html.twig',array('form' => $form->createView()));
    }
    
    
    
    
    public function loginAction()
    {
        return $this->render('UsersBundle:Users:login.html.twig');
    }
    
    
    
    
    public function showAction($username)
    {
        return $this->render('UsersBundle:Users:show.html.twig', array('username' => $username));
    }
    
    
    
    
    public function editAction($username,Request $request)
    {
    	$form = $this->createForm(new EditUserType());  
		$form->handleRequest($request);
      return $this->render('UsersBundle:Users:edit.html.twig',array('form' => $form->createView()));
    }
    
    
    
    
    public function ordersAction($username)
    {
        return $this->render('UsersBundle:Users:orders.html.twig', array('username' => $username));
    }
    
    
    
    
    public function cartAction($username)
    {
        return $this->render('UsersBundle:Users:cart.html.twig', array('username' => $username));
    }
    
    
    
    public function orderProductsAction($id)
    {
        return $this->render('UsersBundle:Users:order_products.html.twig', array('id' => $id));
    }
    
}
