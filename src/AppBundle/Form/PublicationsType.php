<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre', TextType::class, array('label' => 'Titre'))
            ->add('resume', TextareaType::class, array('label' => 'Résumé', 'required' => false))
            ->add('keywords', TextType::class, array('label' => 'Mots clés', 'required' => false))
            ->add('pdfFile', FileType::class, array('label' => 'PDF', 'required' => false))
            ->add('pdfVisible', CheckboxType::class, array('label' => 'PDF visible', 'required' => false))
            ->add('doi', TextType::class, array('label' => 'DOI', 'required' => false))
            ->add('url', TextType::class, array('label' => 'URL', 'required' => false))
            ->add('commentaire', TextareaType::class, array('label' => 'Commentaire libre', 'required' => false))
            ->add('pageDebut', TextType::class, array('label' => 'Page de début', 'required' => false))
            ->add('pageFin', TextType::class, array('label' => 'Page de fin', 'required' => false))
            ->add('moisPublication', ChoiceType::class, array('label' => 'Mois de publication', 'required' => false, 'choices' => array(
                'Janvier' => 1,
                'Février' =>2,
                'Mars' => 3,
                'Avril' => 4,
                'Mai' => 5,
                'Juin' => 6,
                'Juillet' => 7,
                'Août' => 8,
                'Septembre' => 9,
                'Octobre' => 10,
                'Novembre' => 11,
                'Décembre' => 12
            )))

            ->add('anneePublication', TextType::class, array('label' => 'Année de publication', 'data' => 2017))
            ->add('publicationInternationale', ChoiceType::class, array('expanded' => true, 'label' => 'Type de publication', 'data' => true, 'choices' => array('Publication Internationale' => true, 'Publication Nationale' => false)));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'inherit_data' => true
        ));
    }

}
