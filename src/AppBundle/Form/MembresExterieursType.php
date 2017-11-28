<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembresExterieursType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class, array('label' => 'Nom', 'required' => true))
            ->add('prenom', TextType::class, array('label' => 'Prénom', 'required' => true))
            ->add('nomLabo', TextType::class, array('label' => 'Laboratoire/Université', 'required' => false))
            ->add('laboUrca', ChoiceType::class, array('label' => 'Laboratoire URCA', 'choices' => array('Oui' => true, 'Non' => false), 'expanded' => true))
            ->add('international', ChoiceType::class, array('label' => 'Co-auteur international', 'choices' => array('Oui' => true, 'Non' => false), 'expanded' => true))
            ->add('email', TextType::class, array('label' => 'Email', 'required' => false))
            ->add('pays', EntityType::class, array(
                'class'              => 'AppBundle\Entity\Pays',
                'choice_label'       => 'nomFr',
                'label'              => 'pays',
                'translation_domain' => 'messages',
                'required'           => false,
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\MembresExterieurs'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_membresexterieurs';
    }


}
