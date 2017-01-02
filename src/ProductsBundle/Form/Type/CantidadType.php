<?php
namespace ProductsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CantidadType extends AbstractType
{

public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cantidad', 'integer');
        $builder->add('añadir_al_carrito', 'submit',array('translation_domain'=>'formularios'));
    }

	public function getName()
    {
        return 'cantidad';
    }
}