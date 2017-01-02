<?php


namespace UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        
        $session = $request->getSession();
		
        // obtiene el error de inicio de sesión si lo hay
        
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
           // $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
           $session->getFlashBag()->add('error_login', 'Nombre de usuario o Password no válidos');
            
        } 
        else {
            //$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
           // $session->remove(SecurityContext::AUTHENTICATION_ERROR);
          
            $session->getFlashBag()->add('error_login', 'Nombre de usuario o Password no válidos');
            
        }

        //return $this->render('UsersBundle:Security:login.html.twig',array(
                // último nombre de usuario ingresado
            //    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            //    'error'         => $error));
            if($session->has('idioma')){
            return $this->redirect($this->generateUrl('home',array('_locale'=>'en')));
         	}
         	return $this->redirect($this->generateUrl('home'));
    }
}