<?php
namespace UsersBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterType extends AbstractType
{

public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text');
        $builder->add('password', 'text');
        $builder->add('nombre', 'text');
        $builder->add('apellidos', 'text');
        $builder->add('direccion', 'text');
        $builder->add('ciudad', 'text');
        $builder->add('cp', 'text');
        $builder->add('telefono', 'text');
        $builder->add('email', 'text');
        $builder->add('nuevo_usuario', 'submit');
    }

	public function getName()
    {
        return 'register';
    }
}
