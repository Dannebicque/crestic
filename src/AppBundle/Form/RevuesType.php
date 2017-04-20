<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RevuesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titreRevue', TextType::class, array(
            'label'              => 'titreRevue',
            'translation_domain' => 'messages',
            'required'           => true,
            'attr'               => array('class' => 'form-control'),
        ))
            ->add('sigleRevue', TextType::class, array(
                'label'              => 'sigleRevue',
                'translation_domain' => 'messages',
                'required'           => true,
            ))
            ->add('internationale', ChoiceType::class, array(
                'choices'            => array('Oui' => true, 'Non' => false),
                'label'              => 'internationale',
                'translation_domain' => 'messages',
                'required'           => true,
                'expanded'           => true,
            ))
            ->add('impactFactor', TextType::class, array(
                'label'              => 'impactFactor',
                'translation_domain' => 'messages',
                'required'           => true,
            ))
            ->add('classification', TextType::class, array(
                'label'              => 'classification',
                'translation_domain' => 'messages',
                'required'           => true,
            ))
            ->add('url', TextType::class, array(
                'label'              => 'url',
                'translation_domain' => 'messages',
                'required'           => true,
            ))
            ->add('editeur', EntityType::class, array(
                'class'              => 'AppBundle\Entity\Editeurs',
                'choice_label'       => 'nom',
                'label'              => 'editeur',
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
            'data_class' => 'AppBundle\Entity\Revues',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_revues';
    }


}
