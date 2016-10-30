<?php
namespace ProductsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AddProductType extends AbstractType
{

public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', 'text');
        $builder->add('descripcion', 'textarea');
        $builder->add('precio', 'number');
        $builder->add('cantidad', 'integer');
        $builder->add('descuento', 'integer');
        $builder->add('imagen', 'file');
        $builder->add('nuevo_producto', 'submit');
    }

	public function getName()
    {
        return 'add_product';
    }
}
