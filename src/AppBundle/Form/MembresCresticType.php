<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class MembresCresticType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array('required' => true, 'label' => 'Nom'))
            ->add('prenom', TextType::class, array('required' => true, 'label' => 'Prénom'))
            ->add('cnu', ChoiceType::class, array('choices' => array('61' => '61', '27' => '27'), 'required' => false, 'label' => 'CNU'))
            ->add('status', ChoiceType::class, array(
                'choices'    => array(
                    'Professeur'            => 'PR',
                    'Maître de Conférences' => 'MCF',
                    'Post-Doctorant'        => 'PDOC',
                    'ATER'                  => 'ATER',
                    'Doctorant'             => 'DOC',
                    'Administratif'         => 'ADM',
                    'Technicien'            => 'TEC',
                )
                , 'required' => true, 'label' => 'Statut',
            ))
            ->add('site', ChoiceType::class, array(
                'choices'    => array(
                    'Reims'                => 'Reims',
                    'Troyes'               => 'Troyes',
                    'Châlons en Champagne' => 'Châlons en Champagne',
                    'Charleville-Mézières' => 'Charleville-Mézières',
                )
                , 'required' => false, 'label' => 'Site d\'affectation',
            ))
            ->add('batiment', TextType::class, array('required' => false, 'label' => 'Bâtiment'))
            ->add('etage', TextType::class, array('required' => false, 'label' => 'Etage'))
            ->add('bureau', TextType::class, array('required' => false, 'label' => 'Bureau'))
            ->add('datenomination', DateType::class, array('required' => false, 'label' => 'Date de nomination'))
            ->add('email', TextType::class, array('required' => true, 'label' => 'Email'))
            ->add('username', TextType::class, array('required' => true, 'label' => 'Login (Urca si possible)'))
            ->add('role', ChoiceType::class, array(
                'choices'  => array(
                    'Membre du CReSTIC'                       => 'ROLE_UTILISATEUR',
                    'Administrateur du site'                  => 'ROLE_ADMIN',
                    'Responsable d\'équipe/Projet/Plateforme' => 'ROLE_RESPONSABLE',
                ),
                'required' => true, 'label' => 'Autorisations',
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\MembresCrestic',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_membrescrestic';
    }


}
