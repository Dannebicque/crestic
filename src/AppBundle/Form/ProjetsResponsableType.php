<?php

namespace AppBundle\Form;

use AppBundle\Entity\Data;
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
use AppBundle\Entity\CategorieProjet;

class ProjetsResponsableType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, array('label' => 'Titre du projet'))
            ->add('description', TextareaType::class,
                array('label' => 'Description du projet', 'attr' => array('class' => 'tinyMCE')))
            ->add('imageFile', FileType::class, array('label' => 'Illustration du projet', 'required' => false))
            ->add('dateDebut', DateType::class, array('label' => 'Date de début du projet', 'years' => range(2004, date('Y')+3)))
            ->add('dateFin', DateType::class, array('label' => 'Date de fin prévue du projet', 'years' => range(2004, date('Y')+6)))
            ->add('financement', TextType::class, array('label' => 'Modes de financement du projet'))
            ->add('url', TextType::class, array('label' => 'Site Web du projet'))
            ->add('budgetGlobal', TextType::class, array('label' => "Montant du budget global"))
            ->add('video')
            ->add('typeprojet', ChoiceType::class, array('choices' => Data::TAB_CATEGORIES_PROJETS))
            ->add('categorie', EntityType::class, array('class' => CategorieProjet::class, 'choice_label' => 'libelle', 'label' => 'Catégorie de menu'))
            ->add('projetInternational', ChoiceType::class, array(
                'label'    => 'Projet international',
                'choices'  => array('Oui' => true, 'Non' => false),
                'expanded' => true
            ))
            ->add('projetValorisation', ChoiceType::class, array(
                'label'    => 'Projet de valorisation',
                'choices'  => array('Oui' => true, 'Non' => false),
                'expanded' => true
            ))
            ->add('projetThese', ChoiceType::class, array(
                'label'    => 'Projet support d\'une thèse',
                'choices'  => array('Oui' => true, 'Non' => false),
                'expanded' => true
            ))
            ->add('projetRi', ChoiceType::class, array(
                'label'    => 'Projet Relations Internationales',
                'choices'  => array('Oui' => true, 'Non' => false),
                'expanded' => true
            ));
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
