<?php

namespace Extranet\PersonnelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonnelType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite', 'checkbox', array('label' => 'Monsieur', 'required' => false))
            ->add('nom', 'text', array('label' => 'Nom', 'attr' => array('placeholder' => 'Doe')))
            ->add('prenom', 'text', array('label' => 'Prenom', 'attr' => array('placeholder' => 'John')))
            ->add('email', 'email', array('label' => 'E-Mail', 'attr' => array('placeholder' => 'john@doe.com')))
            ->add('tel', 'text', array('label' => 'Tel', 'attr' => array('placeholder' => '01 23 45 67 89')))
            ->add('dob', 'date', array('label' => 'Date de naissance', 'years' => range(\date("Y") - 65, \date("Y")), 'attr' =>array('class' => 'date_select')))
            ->add('pob', 'text', array('label' => 'Lieu de naissance', 'attr' => array('placeholder' => 'Île Maurice')))
            ->add('ss', 'text', array('label' => 'N° de Sécurité Sociale', 'attr' => array('placeholder' => '123456789123')))
            ->add('adresse', 'textarea', array('label' => 'Adresse', 'attr' => array('placeholder' => '18, rue Charles Graindorge, 9310 Bagnolet')))
            ->add('nationalite', 'text', array('label' => 'Nationalité', 'attr' => array('placeholder' => 'Congolais')))
            ->add('active', 'checkbox', array('label' => 'Activer', 'required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Extranet\PersonnelBundle\Entity\Personnel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'extranet_personnelbundle_personnel';
    }
}
