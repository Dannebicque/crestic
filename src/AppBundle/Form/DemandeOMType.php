<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeOMType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('membreCrestic', EntityType::class, array(
                'label'        => 'Membre du CReSTIC',
                'class'        => 'AppBundle\Entity\MembresCrestic',
                'empty_data'   => 'Choisir un responsable',
                'choice_label' => 'display',
                'attr'         => array('class' => 'select2')
            ))
            ->add('dateDepart', DateType::class, array('label' => 'Date de départ'))
            ->add('heureDepart', TimeType::class, array('label' => 'Heure de départ'))
            ->add('dateRetour', DateType::class, array('label' => 'Date de retour'))
            ->add('heureRetour', TimeType::class, array('label' => 'Heure de retour'))
            ->add('objet', TextType::class, array('label' => 'Objet de la mission'))
            ->add('ville', TextType::class, array('label' => 'Ville'))
            ->add('pays', EntityType::class, array('class' => 'AppBundle\Entity\Pays', 'choice_label' => 'nomFr'))
            ->add('commentaire', TextType::class, array('required' => false, 'label' => 'Commentaire sur la demande'))
            ->add('omSansFrais', ChoiceType::class, array(
                'label'    => 'OM sans frais',
                'choices'  => array('Oui' => true, 'Non' => false),
                'expanded' => true
            ))
            ->add('ligneBudget', TextType::class, array('required' => false));

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\DemandeOM'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_demandeom';
    }


}
