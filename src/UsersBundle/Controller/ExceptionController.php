<?php


namespace UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ExceptionController extends Controller
{
	public function showExceptionAction(){
		
		return $this->render('UsersBundle:Users:error.html.twig');
	}

}