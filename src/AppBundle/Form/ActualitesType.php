<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActualitesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, array(
                'label'              => 'Titre',
                'required'           => true,
            ))
            ->add('titreen', TextType::class, array(
                'label'              => 'Title',
                'required'           => false,
                'mapped'             => false,
            ))

//            ->add('keywords', TextType::class, array(
//                'label'              => 'Mots clés',
//                'required'           => true,
//            ))
//            ->add('keywordsen', TextType::class, array(
//                'label'              => 'Keywords',
//                'required'           => false,
//                'mapped'             => false,
//            ))

            ->add('message', TextareaType::class, array(
                'label'              => 'Texte',
                'required'           => true,
                'attr'               => array('class' => 'tinyMCE')
            ))
            ->add('messageen', TextareaType::class, array(
                'label'              => 'Text',
                'required'           => false,
                'attr'               => array('class' => 'tinyMCE'),
                'mapped'             => false,
            ))

            ->add('imageFile', FileType::class, array(
                'label'              => 'Illustration',
                'required'           => false,
            ))

        ;
    }



    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Actualites'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_actualites';
    }


}
