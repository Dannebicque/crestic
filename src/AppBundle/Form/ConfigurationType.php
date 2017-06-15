<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigurationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cle', TextType::class, array(
            'label'              => 'cle',
            'translation_domain' => 'messages',
            'required'           => true,
            'attr'               => array('class' => 'form-control'), //todo: rendre , 'disabled' => true la clé pour éviter les erreurs
        ))
            ->add('value', TextType::class, array(
                'label'              => 'value',
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
            'data_class' => 'AppBundle\Entity\Configuration',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_configuration';
    }


}
