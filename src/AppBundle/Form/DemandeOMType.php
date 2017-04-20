<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeOMType extends AbstractType
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
            ->add('objet')
            ->add('ville')
            ->add('pays')
            ->add('commentaire')
            ->add('etat')
            ->add('omSansFrais')
            ->add('ligneBudget')
            ->add('etatDemande')
            ->add('membreCrestic');
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
