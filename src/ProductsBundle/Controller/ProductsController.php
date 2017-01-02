<?php

namespace ProductsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use ProductsBundle\Form\Type\ProductType;
use ProductsBundle\Form\Type\EditProductType;
use ProductsBundle\Entity\Producto;
use UsersBundle\Form\Type\LoginType;
use ProductsBundle\Form\Type\CantidadType;

class ProductsController extends Controller
{
	
	/******************************   ADD PRODUCT  ************************************************************/	
	
    public function addProductAction(Request $request)
    {
    	
    	//creo el formulario
    	
    	$producto = new Producto();
      $form = $this->createForm(new ProductType(),$producto);  
		$form->handleRequest($request);
		if($form->isValid()){
		
		//obtengo la imagen subida y la muevo a mi directorio de imagenes con el mismo nombre que el nombre del producto
		
			$imagen = str_replace(' ','-',$form->get('nombre')->getData());
			$imagen = $imagen.'.jpg';
		 	$file = $form->get('imagen')->getData();
		 	
		 	//return $this->render('ProductsBundle:Products:pruebas.html.twig',array('prueba' => $imagen));
		 	$dir = $this->container->getparameter('kernel.root_dir').'/../web/images';
		 	$file->move($dir, $imagen);
		 	
		 	//paso la ruta al atributo imagen del producto y persisto la entidad
		 	
		/*	$desc = $form->get('descripcion')->getData();
			$desc1 = str_replace("<","&lt;",$desc);
			$desc = str_replace(">","&gt;",$desc1);
			$producto->setDescripcion($desc);	*/	 	
		 	$producto->setImagen('/images/'.$imagen);
		 	$em=$this->getDoctrine()->getManager();
			$em->persist($producto);
			$em->flush();
		 	return $this->redirect($this->generateUrl('manage_products'));		
		}
      return $this->render('ProductsBundle:Products:add.html.twig',array('form' => $form->createView()));
    }
    
    
    /******************************   EDIT PRODUCT  ************************************************************/
    
    public function editProductAction($id,Request $request)
    {
    	//obtengo el producto y creo el formulario
    	
    	$producto = $this->getDoctrine()->getRepository('ProductsBundle:Producto')->find($id);
    	$form = $this->createForm(new EditProductType(),$producto);  
		$form->handleRequest($request);
		if($form->isValid()){
			
			//modifico producto
			
			/*$producto->setNombre($form->get('nombre')->getData());
			$producto->setDescripcion($form->get('descripicion')->getData());
			$producto->setPrecio($form->get('precio')->getData());
			$producto->setDescuento($form->get('descuento')->getData());
			$producto->setCantidad($form->get('cantidad')->getData());*/
			
			$em = $this->getDoctrine()->getManager();
			$em->persist($producto);
			$em->flush();
			return $this->redirect($this->generateUrl('manage_products'));				
		}
      return $this->render('ProductsBundle:Products:edit.html.twig',array('producto'=>$producto,'form' => $form->createView()));
        
    }
    
    /******************************   SHOW PRODUCT  ************************************************************/
    
    public function showProductAction($product_name, Request $request)
    {
    	$session = $request->getSession();
    	$nombre_producto = str_replace('-',' ',$product_name);
    	//obtengo el producto
    	
    	$producto = $this->getDoctrine()->getRepository('ProductsBundle:Producto')->findOneByNombre($nombre_producto);
    	if($producto == null){
			return $this->render('UsersBundle:Users:error.html.twig');    	
    	}
    	if(!$session->has('username')){ 
    	
    		//formulario de login de la barra de navegacion
    	
    		$form_login = $this->createForm(new LoginType());  
			$form_login->handleRequest($request);  
			if($form_login->isValid()){
				$session->set('login_username', $form_login->get('username')->getData());
				$session->set('login_password', $form_login->get('password')->getData());
				return $this->redirect($this->generateUrl('login',array('form_login'=>$form_login)));
			}	
    	}
    	else{
    		
    		//formulario para la cantidad
    		
    		$form = $this->createForm(new CantidadType());  
			$form->handleRequest($request);
			if($form->isValid()){
				$session->set('cantidad',$form->get('cantidad')->getData());
				return $this->redirect($this->generateUrl('addto_cart',array('id_producto'=>$producto->getId())));
      		
  			}
  			return $this->render('ProductsBundle:Products:show.html.twig',array('producto'=>$producto,'form' => $form->createView()));
  		}
  		return $this->render('ProductsBundle:Products:show.html.twig',array('producto'=>$producto,'form_login'=>$form_login->createView()));
    }
    
    
    
   /******************************   MANAGE PRODUCTS  ************************************************************/
     
    
    public function manageProductAction()
    {
    	
    	//obtengo todos los productos y renderizo a la plantilla
    	
    	$productos = $this->getDoctrine()->getRepository('ProductsBundle:Producto')->findAll();
      return $this->render('ProductsBundle:Products:manage.html.twig',array('productos'=>$productos));
    }


/******************************   DELETE PRODUCTS  ************************************************************/
     
    
    public function deleteProductAction(Request $request,$id)
    {
    	$session = $request->getSession();
    	if($id == 0){
    		$producto = $this->getDoctrine()->getRepository('ProductsBundle:Producto')->find($session->get('producto'));
    		$producto->setIsActive(false);
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($producto);
			$em->flush();
			$session->remove('producto');
			$mt = $this->get('translator')->trans('El producto se ha eliminado correctamente', array(), 'sms');
			$session->getFlashBag()->set('mensaje_exito', $mt);
    		return $this->redirect($this->generateUrl('manage_products'));
    	}
    	
    	$session->set('producto',$id);
    	$producto = $this->getDoctrine()->getRepository('ProductsBundle:Producto')->find($id);
    	
    	return $this->render('ProductsBundle:Products:delete.html.twig',array('producto'=>$producto));
    	
	 }
	 /******************************   SELL PRODUCT  ************************************************************/
	 
	  public function sellProductAction($id)
    {
    	
    	//obtengo producto y modifico su atributo vendiendo
    	
    	$producto = $this->getDoctrine()->getRepository('ProductsBundle:Producto')->find($id);
    	$producto->setVendiendo(true);
    	$em = $this->getDoctrine()->getManager();
		$em->persist($producto);
		$em->flush();
		return $this->redirect($this->generateUrl('manage_products'));
    }
    	
   /******************************   QUIT SELL PRODUCT  ************************************************************/
    
    public function quitSellProductAction($id)
    {
    	
    	//obtengo producto y modifico su atributo vendiendo
    	
    	$producto = $this->getDoctrine()->getRepository('ProductsBundle:Producto')->find($id);
    	$producto->setVendiendo(false);
    	$em = $this->getDoctrine()->getManager();
		$em->persist($producto);
		$em->flush();
		return $this->redirect($this->generateUrl('manage_products'));
    }
    	
 }   	
