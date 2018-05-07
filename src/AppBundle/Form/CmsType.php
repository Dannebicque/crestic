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
            'label'    => 'Titre',
            'required' => true,
        ))
            ->add('texte', TextareaType::class, array(
                'label'    => 'Texte',
                'required' => false,
                'attr'     => array('class' => 'tinyMCE')
            ))
        ->add('titreen', TextType::class, array(
        'label'    => 'Titre (Anglais)',
        'required' => false,
        'data'     =>  $options['data']['titreen'],
        'mapped'   => false,
    ))
        ->add('texteen', TextareaType::class, array(
            'label'    => 'Texte (Anglais)',
            'required' => false,
            'mapped'   => false,
            'data'     =>  $options['data']['texteen'],
            'attr'     => array('class' => 'tinyMCE')
        ));
//            ->add('slug', TextType::class, array(
//                'label'              => 'Slug (ne pas modifier)',
//                'required'           => false,
//            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Cms',
            'titreen' => null,
            'texteen' => null
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
