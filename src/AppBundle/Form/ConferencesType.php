<?php

namespace AppBundle\Form;

use Genemu\Bundle\FormBundle\Form\JQuery\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConferencesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomConference', TextType::class, array(
            'label'              => 'nomConference',
            'translation_domain' => 'messages',
            'required'           => true,
        ))
            ->add('sigleConference', TextType::class, array(
                'label'              => 'sigleConference',
                'translation_domain' => 'messages',
                'required'           => true,
            ))
            ->add('ville', TextType::class, array(
                'label'              => 'ville',
                'translation_domain' => 'messages',
                'required'           => true,
            ))
//            ->add('dateDebut', DateType::class)
//            ->add('dateFin', DateType::class)
            ->add('tauxSelection', TextType::class, array(
                'label'              => 'tauxSelection',
                'translation_domain' => 'messages',
                'required'           => true,
            ))
            ->add('url', TextType::class, array(
                'label'              => 'url',
                'translation_domain' => 'messages',
                'required'           => true,
            ))
            ->add('internationale', ChoiceType::class, array(
                'choices'            => array('Oui' => true, 'Non' => false),
                'label'              => 'internationale',
                'translation_domain' => 'messages',
                'expanded'          => true,
                'required'           => true,
            ))
            ->add('pays', EntityType::class, array(
                'class'              => 'AppBundle\Entity\Pays',
                'choice_label'       => 'nomFr',
                'label'              => 'pays',
                'translation_domain' => 'messages',
                'required'           => false,
            ))
            ->add('editeur', EntityType::class, array(
                'class'              => 'AppBundle\Entity\Editeurs',
                'choice_label'       => 'nom',
                'label'              => 'editeur',
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
            'data_class' => 'AppBundle\Entity\Conferences',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_conferences';
    }


}
