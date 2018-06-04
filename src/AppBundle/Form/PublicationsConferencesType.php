<?php

namespace AppBundle\Form;

use AppBundle\Entity\PublicationsConferences;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationsConferencesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('serie', TextType::class, array('label' => 'Série', 'required' => false))
            ->add('volume', TextType::class, array('label' => 'Volume', 'required' => false))
            ->add('comiteLecture', ChoiceType::class, array(
                'choices'  => array('Oui' => true, 'Non' => false),
                'expanded' => true,
                'label'    => 'Conférence avec comité de lecture'
            ))
            ->add('acte', ChoiceType::class, array(
                'choices'  => array('Oui' => true, 'Non' => false),
                'expanded' => true,
                'label'    => 'Conférence avec actes'
            ))
            ->add('invite', ChoiceType::class, array(
                'choices'  => array('Oui' => true, 'Non' => false),
                'expanded' => true,
                'label'    => 'Session invitée'
            ))
            ->add('poster', ChoiceType::class, array(
                'choices'  => array('Oui' => true, 'Non' => false),
                'expanded' => true,
                'label'    => 'Session Poster'
            ))
            ->add('isbn', TextType::class, array('label' => 'ISBN', 'required' => false))
            ->add('conference', EntityType::class, array(
                'class'        => 'AppBundle\Entity\Conferences',
                'choice_label' => 'conferenceForm',
                'label'        => 'Conférence'
            ))
            ->add('ville', TextType::class, array(
                'label'              => 'ville',
                'translation_domain' => 'messages',
                'required'           => false,
            ))
            ->add('dateDebut', DateType::class, array('years' => range(1980, date('Y')+3)))
            ->add('dateFin', DateType::class, array('years' => range(1980, date('Y')+3)))
            ->add('tauxSelection', TextType::class, array(
                'label'              => 'tauxSelection',
                'translation_domain' => 'messages',
                'required'           => false,
            ))
            ->add('urlConference', TextType::class, array(
                'label'              => 'urlConference',
                'translation_domain' => 'messages',
                'required'           => false,
            ))
            ->add('pays', EntityType::class, array(
                'class'              => 'AppBundle\Entity\Pays',
                'choice_label'       => 'nomFr',
                'label'              => 'pays',
                'translation_domain' => 'messages',
                'required'           => true,
            ))
            ->add('editeur', EntityType::class, array(
                'class'              => 'AppBundle\Entity\Editeurs',
                'choice_label'       => 'nom',
                'label'              => 'editeur',
                'translation_domain' => 'messages',
                'required'           => false,
            ));

        $builder->add('bar', PublicationsType::class, array(
            'data_class' => PublicationsConferences::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\PublicationsConferences'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_publicationsconferences';
    }


}
