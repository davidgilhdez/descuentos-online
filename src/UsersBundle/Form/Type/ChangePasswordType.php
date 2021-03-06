<?php
namespace UsersBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ChangePasswordType extends AbstractType
{

public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('actual_password', 'password');
        $builder->add('new_password', 'password');
        $builder->add('new_password2', 'password');
        $builder->add('cambiar_password', 'submit',array('translation_domain'=>'formularios'));
    }

	public function getName()
    {
        return 'change_password';
    }
}