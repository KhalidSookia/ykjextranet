<?php

namespace Extranet\PersonnelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QualificationType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('qualification', 'text', array('label' => 'Qualification', 'required' => true))
            ->add('active', 'checkbox', array('label' => 'Active', 'required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Extranet\PersonnelBundle\Entity\Qualification'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'extranet_personnelbundle_qualification';
    }
}
