<?php

namespace Extranet\UtilisateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UtilisateurType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entite')
            ->add('adresse')
            ->add('contact')
            ->add('email')
            ->add('tel')
            ->add('active', 'checkbox', array('required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Extranet\UtilisateurBundle\Entity\Utilisateur'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'extranet_utilisateurbundle_utilisateur';
    }
}
