<?php

namespace AppBundle\Form;

use AppBundle\Entity\PublicationsTheses;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationsThesesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateSoutenance', DateType::class, array('label' => 'Date de soutenance'))
            ->add('departement', TextType::class, array('label' => 'Laboratoire de recherche', 'required' => false))
            ->add('discipline', TextType::class, array('label' => 'Discipline ou Champs', 'required' => false))
            ->add('abbrevDepartement', TextType::class, array('label' => 'Abbréviation du laboratoire', 'required' => false))
            ->add('phdorhdr', ChoiceType::class, array('choices' => array('Thèse' => 'phd', 'Habilitation' => 'hdr'), 'expanded' => true, 'label' => 'Thèse ou Habilitation'))
            ->add('universite', TextType::class, array('label' => 'Université'))
            ->add('abbrevUniversite', TextType::class, array('label' => 'Abbréviation de l\'université', 'required' => false))
            ->add('ville', TextType::class, array('label' => 'Ville', 'required' => false))
            ->add('pays', EntityType::class, array('class' => 'AppBundle\Entity\Pays', 'choice_label' => 'nomFR', 'label' => 'Pays', 'required' => false));

        $builder->add('bar', PublicationsType::class, array(
            'data_class' => PublicationsTheses::class,
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\PublicationsTheses'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_publicationstheses';
    }


}
