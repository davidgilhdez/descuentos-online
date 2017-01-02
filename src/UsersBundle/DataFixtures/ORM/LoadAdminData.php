<?php

namespace UsersBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UsersBundle\Entity\Usuario;

class LoadAdminData implements FixtureInterface, ContainerAwareInterface
{
	
	private $container;
	
	public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    
    public function load(ObjectManager $manager)
    {
        $admin = new Usuario(true);
        
        $admin->setUsername('Admin');
        $admin->setNombre("");
        $admin->setApellidos("");
        $admin->setDireccion("");
        $admin->setCiudad("");
        $admin->setCp("");
        $admin->setTelefono("");
        $admin->setEmail('davidgilhdez@gmail.com');
        $admin->setRoles('ROLE_ADMIN');
      
        $plainPassword = "adminpassword";
		  $encoder = $this->container->get('security.password_encoder');
		  $encoded = $encoder->encodePassword($admin, $plainPassword);
		  $admin->setPassword($encoded);
        
        

        $manager->persist($admin);
        $manager->flush();
    }
}