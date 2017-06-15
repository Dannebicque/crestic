<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, array('label' => 'Titre du projet'))
            ->add('description', TextareaType::class, array('label' => 'Description du projet', 'attr' => array('class' => 'tinyMCE')))
            ->add('responsable', EntityType::class, array('label' => 'Responsable de la plateforme',
                'class' =>'AppBundle\Entity\MembresCrestic',
                'empty_data'=> 'Choisir un responsable',
                'choice_label' => 'display', 'attr' => array('class'=> 'select2' )))
            ->add('imageFile', FileType::class, array('label' => 'Illustration du projet', 'required' => false))
            ->add('dateDebut', DateType::class, array('label' => 'Date de début du projet'))
            ->add('dateFin', DateType::class, array('label' => 'Date de fin prévue du projet'))
            ->add('financement', TextType::class, array('label' => 'Modes de financement du projet'))
            ->add('url', TextType::class, array('label' => 'Site Web du projet', 'required' => false))
            ->add('budgetGlobal', TextType::class, array('label' => "Montant du budget global"))
            ->add('video')
            ->add('projetInternational', ChoiceType::class, array('label' => 'Projet international', 'choices' => array('Oui' => true, 'Non' => false), 'expanded' => true))
            ->add('projetValorisation', ChoiceType::class, array('label' => 'Projet de valorisation', 'choices' => array('Oui' => true, 'Non' => false), 'expanded' => true))
            ->add('projetThese', ChoiceType::class, array('label' => 'Projet support d\une thèse', 'choices' => array('Oui' => true, 'Non' => false), 'expanded' => true))
            ->add('projetRi', ChoiceType::class, array('label' => 'Projet Relations Internationales', 'choices' => array('Oui' => true, 'Non' => false), 'expanded' => true))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Projets'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_projets';
    }


}
