<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgendaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre', TextType::class, array('required' => true, 'label' => 'Titre'))
            ->add('description', TextareaType::class, array('attr' => array('class' => 'tinyMCE')))
            ->add('datedebut')
            ->add('heuredebut')
            ->add('datefin')
            ->add('heurefin')
            ->add('lieu', TextType::class, array('required' => true))
            ->add('type', ChoiceType::class, array('choices' => array('Séminaires du laboratoire' => 'Séminaires du laboratoire',
                                                                      'Conférences' => 'Conférences',
                                                                      'Soutenances Thèses/HDR' => 'Soutenances Thèses/HDR',
                                                                      'Réunions' => 'Réunions',
                                                                      'Autres évenements' => 'Autres évenements'
            ), 'required' => true));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Agenda'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_agenda';
    }


}
