<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaysType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('code', TextType::class, array(
            'label'              => 'titre',
            'translation_domain' => 'messages',
            'required'           => true,
        ))
            ->add('alpha2', TextType::class, array(
                'label'              => 'titre',
                'translation_domain' => 'messages',
                'required'           => true,
            ))
            ->add('alpha3', TextType::class, array(
                'label'              => 'titre',
                'translation_domain' => 'messages',
                'required'           => true,
            ))
            ->add('nomEN', TextType::class, array(
                'label'              => 'titre',
                'translation_domain' => 'messages',
                'required'           => true,
            ))
            ->add('nomFR', TextType::class, array(
                'label'              => 'titre',
                'translation_domain' => 'messages',
                'required'           => true,
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Pays'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_pays';
    }


}
