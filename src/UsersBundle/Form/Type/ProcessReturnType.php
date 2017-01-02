<?php
namespace UsersBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProcessReturnType extends AbstractType
{

public function buildForm(FormBuilderInterface $builder, array $options)
    {
		  
		  $builder->add('resolucion', 'choice', array(
   	 'choices'   => array('Positiva' => 'Positiva', 'Negativa' => 'Negativa'),
   	 'required'  => true,
   	 'expanded' => true,
   	 'multiple' => false,));
   	 $builder->add('astock', 'choice', array(
   	 'choices'   => array('Si' => 'Si', 'Reemplazo' => 'No'),
   	 'required'  => false,
   	 'empty_value' => false,
   	 'expanded' => true,
   	 'multiple' => false,
   	 'mapped' => false,
   	 'translation_domain'=>'formularios'));
        $builder->add('procesar', 'submit',array('translation_domain'=>'formularios'));
    }

	public function getName()
    {
        return 'process_return';
    }
}