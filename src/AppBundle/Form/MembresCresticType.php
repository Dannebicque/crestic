<?php

namespace AppBundle\Form;

use AppBundle\Entity\Data;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
            ->add('cnu', ChoiceType::class,
                array('choices' => array('61' => '61', '27' => '27'),
                      'required' => false,
                      'label' => 'CNU',
                      'attr'         => array('class' => 'select2')
            ))
            ->add('departementMembre', EntityType::class, array('class' => 'AppBundle\Entity\Departements', 'choice_label' => 'nom', 'expanded' => true))

            ->add('status', ChoiceType::class, array(
                'choices'  => Data::TAB_STATUS_FORM,
                'required' => true,
                'label'    => 'Statut',
                'attr'         => array('class' => 'select2')
            ))
            ->add('site', ChoiceType::class, array(
                'choices'  => array(
                    'Reims'                => 'Reims',
                    'Troyes'               => 'Troyes',
                    'Châlons en Champagne' => 'Châlons en Champagne',
                    'Charleville-Mézières' => 'Charleville-Mézières',
                )
                ,
                'required' => false,
                'label'    => 'Site d\'affectation',
                'attr'         => array('class' => 'select2')
            ))
            ->add('batiment', TextType::class, array('required' => false, 'label' => 'Bâtiment'))
            ->add('etage', TextType::class, array('required' => false, 'label' => 'Etage'))
            ->add('bureau', TextType::class, array('required' => false, 'label' => 'Bureau'))
            ->add('datenomination', DateType::class, array('required' => false, 'label' => 'Date de nomination'))
            ->add('email', TextType::class, array('required' => true, 'label' => 'Email'))
            ->add('username', TextType::class, array('required' => true, 'label' => 'Login (Urca si possible)'))
            ->add('membreConseilLabo', ChoiceType::class, array(
                'required' => true,
                'label'    => 'Membre du Conseil de laboratoire',
                'choices'  => array('Oui' => true, 'Non' => false),
                'expanded' => true,
                'attr'         => array('class' => 'select2')
            ))
            ->add('role', ChoiceType::class, array(
                'choices'  => array(
                    'Membre du CReSTIC'                       => 'ROLE_UTILISATEUR',
                    'Administrateur du site'                  => 'ROLE_ADMIN',
                    'Responsable d\'équipe/Projet/Plateforme' => 'ROLE_RESPONSABLE',
                ),
                'required' => true,
                'label'    => 'Autorisations',
                'attr'         => array('class' => 'select2')
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
