<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmploisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')
            ->add('resume', TextType::class)
            ->add('description', TextareaType::class, array('attr' => array('class' => 'tinyMCE')))
            ->add('debut', DateType::class, array('label' => 'Début souhaité'))
            ->add('duree', TextType::class, array('label' => 'Durée du contrat'))
            ->add('pdfFile', FileType::class)
            ->add('contact', EntityType::class, array('class' =>'AppBundle\Entity\MembresCrestic', 'choice_label' => 'display', 'attr' => array('class'=> 'select2' )))
            ->add('projet', EntityType::class, array('class' => 'AppBundle\Entity\Projets', 'choice_label' => 'titre', 'attr' => array('class' => 'select2')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Emplois'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_emplois';
    }


}