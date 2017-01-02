<?php

namespace UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use UsersBundle\Entity\Usuario;
use UsersBundle\Entity\Pedido;
use ProductsBundle\Entity\Producto;
use UsersBundle\Entity\Linea_pedido;

class OrdersController extends Controller
{

	/******************************   SHOW ORDERS  ************************************************************/ 

	public function ordersAction(Request $request,$username)
    {
    	
		//obtengo el usuario    	
    	
    	$session = $request->getSession();
    	if($username!=$session->get('username')){
			return $this->redirect($this->generateUrl('error'));		
		}   	
	
    	//obtengo los pedidos del usuario
    	
    	$pedidos = $this->get('fechas.ordenar')->getPedidosOrdenados($this->getUser()->getId());
    	$session->remove('lineas');
      return $this->render('UsersBundle:Users:orders.html.twig', array('pedidos' => $pedidos));
    }
    
    
	/******************************   ADD PRODUCTS TO CART  ************************************************************/    
    
    public function addtoCartAction(Request $request,$id_producto)
    {
    	
		//compruebo si hay lineas erroneas, si las hay las elimino		
		    	
    	$session = $request->getSession();
    	$em = $this->getDoctrine()->getManager();
    	if($session->has('lineas_error')){
			$borralineas = $session->get('lineas_error');
			foreach ($borralineas as $line){
					$l = $this->getDoctrine()->getRepository('UsersBundle:Linea_pedido')->find($line);
					$em->remove($l);
					$em->flush();
					
				}  
			$session->remove('lineas_error');		
    	}
    	
    	$producto = $em->find('ProductsBundle:Producto',$id_producto);
    	$user = $this->getUser();
    	
    	//compruebo si existe una linea con el mismo producto
    	
    	$line = $this->getDoctrine()->getRepository('UsersBundle:Linea_pedido')->findOneBy(
    		array('producto'=>$producto, 'pedido'=>null, 'usuario'=>$user));
    	if($line!=null){
    	$line->setCantidad($line->getCantidad() + $session->get('cantidad'));
    	$line->setImporte($line->getImporte() + ($producto->getPrecio_descuento()*$session->get('cantidad')));
    	$session->remove('cantidad');
    	$em->persist($line);
		$em->flush();
    	}
    	else {
    	
    		//creo una nueva linea
    		
    		$linea = new Linea_pedido();
    		$linea->setProducto($producto);
    		$linea->setImporte($producto->getPrecio_descuento()*$session->get('cantidad'));
    		$linea->setCantidad($session->get('cantidad'));
    		$session->remove('cantidad');
    		$linea->setUsuario($user);
    		$em->persist($linea);
			$em->flush();
    	}
    	return $this->redirect($this->generateUrl('show_cart',array('username'=>$session->get('username'))));	
     	
    }


/******************************   FINISH ORDER  ************************************************************/    
    
    public function finishOrderAction(Request $request)
    {
    	$session = $request->getSession();
		$user = $this->getUser();
    	$em = $this->getDoctrine()->getManager();
    	$lineas = $this->getDoctrine()->getRepository('UsersBundle:Linea_pedido')->findBy(
    		array('usuario'=>$user,'pedido'=>null));
    	$lines = null;
    	$pedido = new Pedido();
    	foreach($lineas as $linea){
    	$linea = $em->find('UsersBundle:Linea_pedido',$linea->getId());
    	
    	//compruebo el stock de los productos antes de persistir el pedido
    	
    	$product = $em->find('ProductsBundle:Producto', $linea->getProducto()->getId());
    	if($product->getCantidad() < $linea->getCantidad()){
    		$linea_error[]=$linea;
    		$ids_lineas[]=$linea->getId();
    		$session->set('lineas_error',$ids_lineas);
    		$session->set('lineas',true);
			
    	}
    	else{
			$lines[] = $linea;    	
    	}	
    	}
    	
    	//hay error al crear el pedido
    	
    	if(isset($linea_error)){
    		$mt = $this->get('translator')->trans('Error al crear pedido, el stock de algunos artículos es inferior al solicitado');
			$session->getFlashBag()->add('mensaje_error', $mt);
			
    		return $this->render('UsersBundle:Users:cart.html.twig', array('linea_error'=>$linea_error, 'lines'=>$lines));
    	}
    	else{
    		
    	//el pedido es correcto, se persiste
    	
    	foreach($lineas as $linea){
    	$linea = $em->find('UsersBundle:Linea_pedido',$linea->getId());
    
		$pedido->addLineasPedido($linea); 
		$linea->setPedido($pedido); 
		$linea->getProducto()->setCantidad($linea->getProducto()->getCantidad() - $linea->getCantidad());
		}	
    	}
    	$pedido->setImporte($pedido->calcularImporte());
    	$pedido->setFecha(new \DateTime());
    	$usuario = $this->getDoctrine()->getRepository('UsersBundle:Usuario')->find($session->get('id_usuario'));
		$pedido->setUsuario($usuario);    	
    	$usuario->addPedido($pedido);
    	$session->remove('lineas'); 	
    	
    	
		$em->persist($pedido);
		$em->flush();
		$mt = $this->get('translator')->trans('Pedido realizado con éxito');
		$session->getFlashBag()->add('mensaje_exito', $mt);
		return $this->redirect($this->generateUrl('show_orders', array('username'=>$session->get('username'))));
    	
    }
    
    /******************************   SHOW CART  ************************************************************/
    
    
    public function cartAction(Request $request,$username)
    {
    	$session = $request->getSession();
    	$session->remove('lineas');
    	$em = $this->getDoctrine()->getManager();
    	if($username!=$session->get('username')){
			return $this->redirect($this->generateUrl('error'));		
		}   	
		
		//si existen lineas con error se eliminan
		
		if($session->has('lineas_error')){
			$borralineas = $session->get('lineas_error');
			foreach ($borralineas as $line){
					$l = $this->getDoctrine()->getRepository('UsersBundle:Linea_pedido')->find($line);
					$em->remove($l);
					$em->flush();
					
				}  
			$session->remove('lineas_error');		
    	}
			
		//se muestra el carrito			
			 		
    	$user = $this->getUser();
    	$lineas = $this->getDoctrine()->getRepository('UsersBundle:Linea_pedido')->findBy(
    		array('usuario'=>$user,'pedido'=>null));
    	if($lineas!=null){
    		
    			$session->set('lineas',true);
    			
    			return $this->render('UsersBundle:Users:cart.html.twig', array('lineas'=>$lineas));
    		}
    	
        return $this->render('UsersBundle:Users:cart.html.twig');
    }
    
    /******************************   SHOW PRODUCTS IN ONE ORDER  ************************************************************/
    
    public function orderProductsAction(Request $request,$id,$username)
    {
    	
    	$session = $request->getSession();
    	if($username==$session->get('username') || $this->getUser()->getRoles()[0]=="ROLE_LOGISTICS"){
			
		
    	//obtengo el pedido
    	
    	$pedido = $this->getDoctrine()->getRepository('UsersBundle:Pedido')->find($id);
    	if($pedido == null){
			return $this->render('UsersBundle:Users:error.html.twig');    	
    	}
    	$lineas = ($pedido->getLineasPedido());
    	return $this->render('UsersBundle:Users:order_products.html.twig', array('lineas' => $lineas));
      }
      else{
      	return $this->redirect($this->generateUrl('error'));			
		}   	
    }
    
    
    /******************************   DELETE LINE  ************************************************************/
    
     public function deleteLineAction($id,Request $request,$loop)
    {
    	$session = $request->getSession();
    	
    	//si solo hay una línea, se elimina (carrito vacío)
    	
    	if($loop==1){
		$session->remove('lineas');    	
    	}
    	
		//hay más de una línea, se elimina   	
    	
    	$em = $this->getDoctrine()->getManager();
    	$linea = $em->find('UsersBundle:Linea_pedido',$id);
    	$em->remove($linea);
    	$em->flush();
    	return $this->redirect($this->generateUrl('show_cart',array('username'=>$session->get('username'))));
    	
    }

}
