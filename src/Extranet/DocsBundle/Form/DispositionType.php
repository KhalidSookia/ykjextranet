<?php

namespace Extranet\DocsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Extranet\DiversBundle\Form\EnteteType;
use Extranet\PersonnelBundle\Form\PersonnelType;
use Extranet\UtilisateurBundle\Form\UtilisateurType;
use Extranet\PersonnelBundle\Form\QualificationType;
use Extranet\DiversBundle\Form\TauxType;
use Extranet\DiversBundle\Form\ConditionsType;
use Extranet\DiversBundle\Form\PiedType;
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
            ->add('datedebut', 'date', array('label' => 'Date Début', 'years' => range(\date("Y"), \date("Y") +1), 'attr' =>array('class' => 'date_select')))
            ->add('heuredebut', 'time', array('label' => 'Heure Début', 'attr' =>array('class' => 'date_select')))
            ->add('dureequotidienne', 'time', array('label' => 'Durée quotidienne', 'attr' =>array('class' => 'date_select')))
            ->add('taux', new TauxType(), array('label' => false, 'required' => false))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Extranet\DocsBundle\Entity\Disposition'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'extranet_docsbundle_disposition';
    }
}
