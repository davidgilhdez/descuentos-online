<?php
namespace UsersBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ChangeUsersType extends AbstractType
{

public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('modificar', 'submit',array('translation_domain'=>'formularios'));
    }

	public function getName()
    {
        return 'change_user';
    }
}