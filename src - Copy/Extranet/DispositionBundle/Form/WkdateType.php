<?php

namespace Extranet\DispositionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WkdateType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datedebut', 'date', array('label' => 'Date Début', 'years' => range(\date("Y"), \date("Y") +1), 'attr' =>array('class' => 'date_select')))

            ->add('heuredebut', 'time', array('label' => 'Heure Début', 'attr' =>array('class' => 'date_select')))

            ->add('dureequotidienne', 'time', array('label' => 'Durée quotidienne', 'attr' =>array('class' => 'date_select')))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Extranet\DispositionBundle\Entity\Wkdate'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'extranet_dispositionbundle_wkdate';
    }
}
