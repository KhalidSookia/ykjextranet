<?php

namespace Extranet\DiversBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EnteteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text', array('label' => 'Nom de référence', 'required' => true))
            ->add('entete', 'textarea', array('label' => 'Entete', 'required' => true))
            ->add('active', 'checkbox', array('label' => 'Active', 'required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Extranet\DiversBundle\Entity\Entete'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'extranet_diversbundle_entete';
    }
}
