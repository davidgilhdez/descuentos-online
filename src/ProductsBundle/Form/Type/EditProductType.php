<?php
namespace ProductsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EditProductType extends AbstractType
{

public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', 'text');
        $builder->add('descripcion', 'textarea',array('attr'=>array('rows'=>"10", 'cols'=>"80",'class' => 'tinymce',
        'data-theme' => 'bbcode')));
        $builder->add('descripcion_en', 'textarea',array('attr'=>array('rows'=>"10", 'cols'=>"80",'class' => 'tinymce',
        'data-theme' => 'bbcode')));
        $builder->add('precio', 'number');
        $builder->add('cantidad', 'text');
        $builder->add('descuento', 'text');
        $builder->add('editar_producto', 'submit',array('translation_domain'=>'formularios'));
    }

	public function getName()
    {
        return 'edit_product';
    }
}
