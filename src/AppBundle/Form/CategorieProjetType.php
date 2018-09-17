<?php

namespace AppBundle\Form;

use AppBundle\Entity\CategorieProjet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategorieProjetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libelle', TextType::class, array(
            'label'    => 'Libellé',
            'required' => true,
        ))
            ->add('libelleEn', TextType::class, array(
                'label'    => 'Libellé Anglais',
                'required' => true,
            ))
            ->add('parent', EntityType::class, array(
                'class' => CategorieProjet::class,
                'choice_label' => 'libelle',
                'label' => 'Catégorie parent (vide si aucune)',
                'required' => false
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CategorieProjet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_categorieprojet';
    }


}
