<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembresCresticUtilisateurEnType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('site', TextType::class,
                array('attr' => array('placeholder' => 'Site du CReSTIC'), 'required' => false))
            ->add('batiment', TextType::class, array('attr' => array('placeholder' => 'Bâtiment'), 'required' => false))
            ->add('bureau', TextType::class, array('attr' => array('placeholder' => 'Bureau'), 'required' => false))

            ->add('cvEn', TextareaType::class, array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('themesEn', TextareaType::class, array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('responsabilitesScientifiquesEn', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('responsabilitesAdministrativesEn', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('valorisationEn', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('vulgarisationEn', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('internationalEn', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('enseignementsEn', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('evaluationEn', TextareaType::class, array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('editorialEn', TextareaType::class, array('attr' => array('class' => 'tinyMCE'), 'required' => false));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\MembresCrestic'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_membrescrestic';
    }


}
