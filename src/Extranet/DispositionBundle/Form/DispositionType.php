<?php

namespace Extranet\DispositionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Extranet\PersonnelBundle\Form\PersonnelType;
use Extranet\UtilisateurBundle\Form\UtilisateurType;
use Extranet\PersonnelBundle\Form\QualificationType;
use Extranet\DispositionBundle\Form\WkdateType;
use Extranet\DiversBundle\Form\TauxType;
use Doctrine\ORM\EntityRepository;

class DispositionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('personnel', 'entity', array('class' => 'ExtranetPersonnelBundle:Personnel', 'property' => 'nom', 'property' => 'prenom', 'label' => 'Personnel'))
            ->add('qualification', 'entity', array('class' => 'ExtranetPersonnelBundle:Qualification', 'property' => 'qualification', 'label' => 'Qualification'))
            ->add('utilisateur', 'entity', array('class' => 'ExtranetUtilisateurBundle:Utilisateur', 'property' => 'entite', 'label' => 'Client'))
            ->add('wkdate', 'collection', array('type' => new WkdateType(), 'allow_add' => true,'allow_delete' => true, 'label' => false, 'required' => false, 'by_reference' => false))
            ->add('taux', new TauxType(), array('label' => false, 'required' => false))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Extranet\DispositionBundle\Entity\Disposition'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'extranet_dispositionbundle_disposition';
    }
}
