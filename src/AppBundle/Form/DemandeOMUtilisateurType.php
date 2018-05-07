<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeOMUtilisateurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateDepart')
            ->add('heureDepart')
            ->add('dateRetour')
            ->add('heureRetour')
            ->add('objet', TextType::class, array('label' => 'Objet de la mission'))
            ->add('ville', TextType::class, array('label' => 'Ville'))
            ->add('commentaire', TextType::class, array('required' => false))
            ->add('omSansFrais', ChoiceType::class, array(
                'label'    => 'OM Sans Frais',
                'choices'  => array('Oui' => true, 'Non' => false),
                'expanded' => true
            ))
            ->add('ligneBudget', TextType::class, array('required' => true, 'label' => 'Projet ou convention'))
            ->add('pays', EntityType::class, array('class' => 'AppBundle\Entity\Pays', 'choice_label' => 'nomFr'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\DemandeOM'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_demandeom';
    }


}
