<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlateformesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class, array('label' => 'Nom de la plateforme'))
            ->add('localisation', TextType::class, array('label' => 'Localisation de la plateforle'))
            ->add('imageFile', FileType::class, array('label' => 'Illustration de la plateforme', 'required' => false))
            ->add('url', TextType::class, array('label' => 'Site web de la plateforme', 'required' => false))
            ->add('responsable', EntityType::class, array('label' => 'Responsable de la plateforme',
                'class' =>'AppBundle\Entity\MembresCrestic',
                'empty_data'=> 'Choisir un responsable',
                'choice_label' => 'display', 'attr' => array('class'=> 'select2' )));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Plateformes'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_plateformes';
    }


}
