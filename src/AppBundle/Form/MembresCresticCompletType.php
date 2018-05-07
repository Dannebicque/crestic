<?php

namespace AppBundle\Form;

use AppBundle\Entity\Data;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class MembresCresticCompletType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array('required' => true, 'label' => 'Nom'))
            ->add('prenom', TextType::class, array('required' => true, 'label' => 'Prénom'))
            ->add('email', TextType::class, array('required' => true, 'label' => 'Email URCA'))
            ->add('username', TextType::class, array('required' => true, 'label' => 'Login URCA'))
            ->add('slug', TextType::class, array('required' => false, 'label' => 'Slug (pour l\'URL du profil)'))
            ->add('idhal', TextType::class, array('required' => false, 'label' => 'Id-Hal'))
            ->add('imageFile', FileType::class, array('required' => false, 'label' => 'Photo'))
            ->add('dateNaissance', DateType::class, array(
                'required' => false,
                'widget'   => 'single_text',
                'format'   => 'dd/MM/yyyy',
                'attr'     => array('placeholder' => 'dd/mm/aaaa'),
                'label'    => 'Date de naissance'
            ))
            ->add('adresse', TextType::class, array('label' => 'Adresse professionnelle', 'required' => false))
            ->add('site', ChoiceType::class, array(
                'choices'  => array(
                    'Châlons en Champagne' => 'Châlons en Champagne',
                    'Charleville-Mézières' => 'Charleville-Mézières',
                    'Reims'                => 'Reims',
                    'Troyes'               => 'Troyes'
                ),
                'label'    => 'Site du CReSTIC',
                'required' => false
            ))
            ->add('batiment', TextType::class, array('label' => 'Bâtiment', 'required' => false))
            ->add('bureau', TextType::class, array('label' => 'Bureau', 'required' => false))
            ->add('tel', TextType::class, array('label' => 'Téléphone Pro.', 'required' => false))
            ->add('telPortable', TextType::class, array('label' => 'télpéhone Port.', 'required' => false))
            ->add('disciplinehceres', TextType::class, array('required' => false, 'label' => 'Discipline HCERES'))
            ->add('status', ChoiceType::class, array(
                'choices'  => Data::TAB_STATUS_FORM,
                'required' => true,
                'label'    => 'Statut',
            ))
            ->add('cnu', ChoiceType::class,
                array('choices' => array('61' => '61', '27' => '27'), 'required' => false, 'label' => 'CNU'))
            ->add('departementMembre', EntityType::class, array('class' => 'AppBundle\Entity\Departements', 'choice_label' => 'nom', 'expanded' => true))
            ->add('hdr', ChoiceType::class, array(
                'label'    => 'Titulaire de l\'hdr',
                'choices'  => array('Oui' => true, 'Non' => false),
                'required' => false
            ))
            ->add('datenomination', DateType::class, array('required' => false, 'label' => 'Date de nomination'))
            ->add('corpsgrade', TextType::class, array('label' => 'Corps/Grade', 'required' => false))
            ->add('adressePerso', TextType::class, array('label' => 'Adresse personnelle', 'required' => false))
            ->add('emailPerso', TextType::class, array('label' => 'Email personnelle', 'required' => false))
            ->add('url', TextType::class, array('label' => 'Site Web', 'required' => false))
            ->add('cv', TextareaType::class, array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('themes', TextareaType::class, array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('responsabilitesScientifiques', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('responsabilitesAdministratives', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('evaluation', TextareaType::class, array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('editorial', TextareaType::class, array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('valorisation', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('vulgarisation', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('international', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('enseignements', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('responsabiliteFonction', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('ancienMembresCrestic', ChoiceType::class, array(
                'label'    => 'Ancien membre du CReSTIC',
                'choices'  => array('Oui' => true, 'Non' => false),
                'expanded' => true
            ))
            ->add('membreAssocie', ChoiceType::class, array(
                'label'    => 'Membre associé',
                'choices'  => array('Oui' => true, 'Non' => false),
                'expanded' => true
            ))
            ->add('membreConseilLabo', ChoiceType::class, array(
                'label'    => 'Membre du conseil de laboratoire',
                'choices'  => array('Oui' => true, 'Non' => false),
                'expanded' => true
            ))
            ->add('role', ChoiceType::class, array(
                'choices'  => array(
                    'Membre du CReSTIC'                       => 'ROLE_UTILISATEUR',
                    'Administrateur du site'                  => 'ROLE_ADMIN',
                    'Responsable d\'équipe/Projet/Plateforme' => 'ROLE_RESPONSABLE',
                ),
                'required' => true,
                'label'    => 'Autorisations',
            ));;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\MembresCrestic'
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
