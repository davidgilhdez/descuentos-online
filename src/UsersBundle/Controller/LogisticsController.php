<?php

namespace UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use UsersBundle\Form\Type\ReturnType;
use UsersBundle\Form\Type\ProcessReturnType;
use UsersBundle\Entity\Usuario;
use UsersBundle\Entity\Pedido;
use UsersBundle\Entity\Linea_pedido;
use UsersBundle\Entity\Devolucion;
use ProductsBundle\Entity\Producto;
use UsersBundle\Event\LogEvent;



class LogisticsController extends Controller
{
/******************************  PENDING ORDERS ************************************************************/ 
 
public function pendingOrdersAction()
    {
    	$pendientes = $this->getDoctrine()->getRepository('UsersBundle:Pedido')->findByFechaprocesado(null);
		
    	return $this->render('UsersBundle:Users:pending_orders.html.twig',array('pendientes'=>$pendientes));
	    	
    }          

	/******************************  PREPARING ORDERS ************************************************************/ 
 
public function preparingOrdersAction($id)
    {
		$procesando = $this->getDoctrine()->getRepository('UsersBundle:Pedido')->find($id);
		$procesando->setEstado("Preparando");
		$em = $this->getDoctrine()->getManager();
		$em->persist($procesando);
		$em->flush();
		return $this->redirect($this->generateUrl('pending_orders'));
    
    
    }
    
		/******************************  PREPARE PRODUCTS ************************************************************/     
    
    public function prepareProductsAction()
    {
    	
    	$preparando = $this->getDoctrine()->getRepository('UsersBundle:Pedido')->findByEstado("Preparando");
    	if($preparando == null){
		   return $this->redirect($this->generateUrl('pending_orders')); 	
    	}
    	$lineas = array();
    			 
    	//obtengo la cantidad necesaria de cada producto para preparar los pedidos en estado preparando
    	
    	for($i=0;$i<sizeof($preparando);$i++){
    		for($j=0;$j<sizeof($preparando[$i]->getLineasPedido());$j++){
    			$activa=$preparando[$i]->getLineasPedido()[$j];
    			$k=0;
    			while(isset($lineas[$k])){
    				if($activa->getProducto()->getId() == $lineas[$k]->getProducto()->getId()){
    			 		$lineas[$k]->setCantidad($lineas[$k]->getCantidad() + $activa->getCantidad());
    			 		break;
    			 	}
    			 	else{
						$k++;  			 	
    			 	}
    			}
    			if(!isset($lineas[$k])){
    			$lineas[$k]=$activa; 	
  				}	    		
    		}
    	}
    
    	return $this->render('UsersBundle:Users:prepare_products.html.twig',array('lineas'=>$lineas)); 
    
    }
    
    	/******************************  PROCESED ORDERS ************************************************************/     
    
    public function procesedOrdersAction()
    {
    
    $procesados = $this->get('fechas.ordenar')->getPedidosProcesados();
   // $procesados = $this->getDoctrine()->getRepository('UsersBundle:Pedido')->findByEstado("Finalizado");
    return $this->render('UsersBundle:Users:procesed_orders.html.twig',array('procesados'=>$procesados));
    
    }
    
	/******************************  FINISHING ORDERS ************************************************************/ 
 
public function finishingOrdersAction($id, Request $request)
    {
    	$finalizado = $this->getDoctrine()->getRepository('UsersBundle:Pedido')->find($id);
		$finalizado->setEstado("Finalizado");
		$finalizado->setFechaProcesado(new \DateTime());
		
		
		$this->get('knp_snappy.pdf')->generateFromHtml(
    	$this->renderView(
        'UsersBundle:Users:pdf.html.twig',
        array(
            'pedido'=>$finalizado
        )
    ),
    'etiquetas/Ref_'.$id.'.pdf'
);
	$finalizado->setEtiqueta('etiquetas/Ref_'.$id.'.pdf');
	$em = $this->getDoctrine()->getManager();
	$em->persist($finalizado);
	$em->flush();
	return new BinaryFileResponse('etiquetas/Ref_'.$id.'.pdf');
	
    }
    
    /******************************  SHOW LABEL ************************************************************/ 
 
public function showLabelAction($id)
    {
    	return new BinaryFileResponse('etiquetas/Ref_'.$id.'.pdf');
    }
}