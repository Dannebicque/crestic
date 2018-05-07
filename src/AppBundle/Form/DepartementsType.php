<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DepartementsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class, array('label' => 'Nom du département'))
            ->add('sigle', TextType::class, array('label' => 'Sigle du département'))
            ->add('theme', TextareaType::class, array(
                'label' => 'Thématiques du départemen t',
                'attr'  => array('class' => 'tinyMCE')
            ))
            ->add('membreCrestic', EntityType::class, array(
                'label'        => 'Responsable du département',
                'class'        => 'AppBundle\Entity\MembresCrestic',
                'empty_data'   => 'Choisir un responsable',
                'choice_label' => 'display',
                'attr'         => array('class' => 'select2')
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Departements'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_departements';
    }


}
