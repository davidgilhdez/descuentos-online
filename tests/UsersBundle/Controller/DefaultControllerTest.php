<?php

namespace UsersBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
   /* public function testUsuarioSeRegistra()
    {
       $client = static::createClient();
        
        //cargar portada

       $crawler = $client->request('GET', '/');
        
		  $fs = new \Symfony\Component\Filesystem\Filesystem();
        $fs->dumpFile('./error_pruebas.html', $client->getInternalResponse()->getContent());        
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode(),'La portada se carga correctamente');
        
        //existe enlace de registro
        
        $registro = $crawler->filter('a:contains("Registrarse")')->count();
        $this->assertEquals(1, $registro,'La portada muestra un enlace de registro');
        
      //pulsa sobre el enlace de registro y le redirige al formulario de registro
        
        $enlace_registro = $crawler->filter('a:contains("Registrarse")')->link();
		  $crawler = $client->click($enlace_registro);
		  
		  //$crawler = $client->followRedirect();
		  
		 // $this->assertTrue($client->getResponse()->isRedirect('/es/register'),"Redirige al formulario de registro");
		 
		  $label_registro = $crawler->filter('html:contains("Registro de Nuevo Usuario")')->count();
		  $this->assertEquals(1, $label_registro,'El cliente se encuentra en el formulario de registro');
		  
		  //rellena el formulario de registro y lo envía
		  
		 $usuario = array(
		  'register[username]'=>'miusername',
		  'register[password]'=>'mipassword',
		  'register[repassword]'=>'mipassword',
		  'register[nombre]'=>'mi nombre',
		  'register[apellidos]' => 'mis apellidos',
		  'register[direccion]'=>'mi dirección',
		  'register[ciudad]'=>'mi ciudad',
		  'register[cp]'=>'11111',
		  'register[telefono]'=>'123456789',
		  'register[email]'=>'miemail@email.com');
		  
		  $formulario = $crawler->selectButton('register[nuevo_usuario]')->form($usuario);
		  $client->submit($formulario);

		  $crawler = $client->followRedirect();
		  
		//$this->assertTrue($client->getResponse()->isRedirect(),"Redirige a index");
		  $exito_registro = $crawler->filter('html:contains("Te has registrado con éxito, Inicia sesión para acceder a tu cuenta")')->count();
		  $this->assertEquals(1, $exito_registro,'El cliente se ha registrado correctamente');
		
		
    }
    */
    public function testUsuarioHacePedido()
    {
		
	 	$client = static::createClient();

      $crawler = $client->request('GET', '/'); 
      
      //el usuario se loguea
      
      $usuario = array(
		  '_username'=>'miusername',
		  '_password'=>'mipassword');
      
      $login = $crawler->selectButton('entrar')->form($usuario);
      $client->submit($login);
      
     $crawler = $client->followRedirect();
     $crawler = $client->followRedirect();
      
       
      
		$exito_login = $crawler->filter('a:contains("Mi perfil")')->count();
		$this->assertEquals(1, $exito_login,'El usuario se ha logueado correctamente'); 
		
		
		//selecciona un producto
	
		$productos = $crawler->filter('div.elemento a:contains("49.46€")')->link(); //obtengo los productos de la portada
		//$enlace_producto = $crawler->selectLink($productos)->eq(0)->link(); //selecciono por ejemplo el primero
		$crawler = $client->click($productos); 
		
		//$crawler = $client->followRedirect();
		
      $exito_producto = $crawler->filter('html:contains("Descripción del producto")')->count();
		$this->assertEquals(1, $exito_producto,'El usuario es redirigido a la página del producto');
		
		
		//añade el producto al carrito
		
      $addto_cart = $crawler->selectButton('cantidad[añadir_al_carrito]')->form(); //la cantidad se establece en 1
      $client->submit($addto_cart);
      
      $crawler = $client->followRedirect();
      $crawler = $client->followRedirect();
      
      
      
      $cart = $crawler->filter('html:contains("Mi Carrito")')->count();
		$this->assertEquals(1, $cart,'El usuario es redirigido a la página del carrito');
		
		
		
		//finaliza la compra
		
		$fin = $crawler->filter('a:contains("Finalizar compra")')->link(); //enlace de finalizar compra
		$crawler = $client->click($fin);
      
     $crawler = $client->followRedirect();
     
     $fs = new \Symfony\Component\Filesystem\Filesystem();
        $fs->dumpFile('./error_pruebas.html', $client->getInternalResponse()->getContent());
      
      $exito_pedido = $crawler->filter('html:contains("Pedido realizado con éxito")')->count(); //busco el mensaje de exito
		$this->assertEquals(1, $exito_pedido,'El pedido se ha efectuado correctamente'); 
      	
    	
    }
}
