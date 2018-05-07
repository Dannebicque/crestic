<?php

namespace AppBundle\Form;

use AppBundle\Entity\Data;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrganigrammeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('responsabiliteFonction', ChoiceType::class,
            array('label' => 'Responsabilité', 'choices' => Data::TAB_ORGANIGRAMME))
            ->add('ordre', ChoiceType::class, array(
                'label'      => 'Ordre dans l\'organigramme',
                'choices'    => array('1' => 1, '2' => 2, '3' => 3, '4' => 4),
                'empty_data' => 1
            ))
            ->add('membreCrestic', EntityType::class, array(
                'label'        => 'Membre du CReSTIC',
                'class'        => 'AppBundle\Entity\MembresCrestic',
                'empty_data'   => 'Choisir le membre',
                'choice_label' => 'display',
                'attr'         => array('class' => 'select2')
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Organigramme'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_organigramme';
    }


}
