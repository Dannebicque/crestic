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
                'label'              => 'titre',
                'translation_domain' => 'messages',
                'required'           => true,
            ))

            ->add('keywords', TextType::class, array(
                'label'              => 'keywords',
                'translation_domain' => 'messages',
                'required'           => true,
            ))

            ->add('message', TextareaType::class, array(
                'label'              => 'texte',
                'translation_domain' => 'messages',
                'required'           => true,
                'attr'               => array('class' => 'tinyMCE')
            ))

            ->add('imageFile', FileType::class, array(
                'label'              => 'illustration',
                'translation_domain' => 'messages',
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
