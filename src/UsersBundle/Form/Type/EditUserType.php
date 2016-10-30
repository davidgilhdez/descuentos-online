<?php
namespace UsersBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EditUserType extends AbstractType
{

public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', 'text');
        $builder->add('apellidos', 'text');
        $builder->add('direccion', 'text');
        $builder->add('ciudad', 'text');
        $builder->add('cp', 'text');
        $builder->add('telefono', 'text');
        $builder->add('email', 'text');
        $builder->add('actual_password', 'text');
        $builder->add('new_password', 'text');
        $builder->add('new_password2', 'text');
        $builder->add('editar_perfil', 'submit');
    }

	public function getName()
    {
        return 'edit_user';
    }
}
