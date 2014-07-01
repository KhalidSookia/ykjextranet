<?php

namespace Extranet\DiversBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TauxType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('normale', 'money', array('attr' => array('required' => true, 'label' => 'Heures Normales')))
            ->add('repas', 'money', array('attr' => array('required' => true)))
            ->add('transport', 'money', array('attr' => array('required' => true)))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Extranet\DiversBundle\Entity\Taux'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'extranet_diversbundle_taux';
    }
}
