<?php
namespace UsersBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterType extends AbstractType
{

public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text',array('translation_domain'=>'validators'));
        $builder->add('password', 'password',array('translation_domain'=>'validators'));
        $builder->add('repassword','password', array('mapped' => false));
        $builder->add('nombre', 'text');
        $builder->add('apellidos', 'text');
        $builder->add('direccion', 'text');
        $builder->add('ciudad', 'text');
        $builder->add('cp', 'text');
        $builder->add('telefono', 'text');
        $builder->add('email', 'email',array('translation_domain'=>'validators'));
        $builder->add('nuevo_usuario', 'submit',array('translation_domain'=>'formularios'));
    }

	public function getName()
    {
        return 'register';
    }
}
