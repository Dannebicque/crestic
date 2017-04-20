<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CmsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre', TextType::class, array(
            'label'              => 'titre',
            'translation_domain' => 'messages',
            'required'           => true,
            'attr'               => array('class' => 'form-control')
        ))
            ->add('texte', TextareaType::class, array(
                'label'              => 'texte',
                'translation_domain' => 'messages',
                'required'           => false,
                'attr'               => array('class' => 'form-control')
            ))
            ->add('slug', TextType::class, array(
                'label'              => 'slug',
                'translation_domain' => 'messages',
                'required'           => false,
                'attr'               => array('class' => 'form-control'), //todo: rendre disabled le slug pour éviter les bugs
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Cms',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_cms';
    }


}