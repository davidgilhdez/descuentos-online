<?php
namespace UsersBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ReturnType extends AbstractType
{

public function buildForm(FormBuilderInterface $builder, array $options)
    {
		  $builder->add('cantidad', 'integer');	
		  $builder->add('tipo', 'choice', array(
   	 'choices'   => array('Reembolso' => 'Reembolso', 'Reemplazo' => 'Reemplazo'),
   	 'required'  => true,
   	 'expanded' => true,
   	 'multiple' => false,
   	 'translation_domain'=>'formularios'));
   	 $builder->add('observaciones', 'textarea',array('attr'=>array('rows'=>"10", 'cols'=>"60")));
        $builder->add('devolver', 'submit',array('translation_domain'=>'formularios'));
    }

	public function getName()
    {
        return 'return';
    }
}