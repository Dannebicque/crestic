<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class, array('label' => 'Nom cours (sigle) de l\'équipe'))
            ->add('nomlong', TextType::class, array('label' => 'Nom long de l\'équipe'))
            ->add('imageFile', FileType::class, array('label' => 'Illustration de l\'équipe', 'required' => false))
            ->add('responsable', EntityType::class, array(
                'label'        => 'Responsable de l\'équipe',
                'class'        => 'AppBundle\Entity\MembresCrestic',
                'empty_data'   => 'Choisir un responsable',
                'choice_label' => 'display',
                'attr'         => array('class' => 'select2')
            ))
            ->add('themeRecherche', TextareaType::class, array(
                'label' => 'Thématiques de recherche',
                'attr'  => array('class' => 'tinyMCE')
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Equipes'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_equipes';
    }


}
