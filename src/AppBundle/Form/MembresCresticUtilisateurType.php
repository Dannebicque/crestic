<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembresCresticUtilisateurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//->add('disciplinehceres', TextType::class, array('attr' => array('placeholder' => 'Discipline HCERES'), 'required' => false))
//            ->add('hdr')
            ->add('datenomination', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr'   => array('placeholder' => 'dd/mm/aaaa')
            ))
            ->add('idhal', TextType::class, array('required' => false, 'label' => 'Id-Hal'))
            ->add('corpsgrade', TextType::class, array('attr' => array('placeholder' => 'Corps/Grade')))
            ->add('site', TextType::class,
                array('attr' => array('placeholder' => 'Site du CReSTIC'), 'required' => false))
            ->add('batiment', TextType::class, array('attr' => array('placeholder' => 'Bâtiment'), 'required' => false))
            ->add('bureau', TextType::class, array('attr' => array('placeholder' => 'Bureau'), 'required' => false))
            ->add('email', TextType::class, array('attr' => array('placeholder' => 'Email professionnel')))
            ->add('emailPerso', TextType::class,
                array('attr' => array('placeholder' => 'Email Perso'), 'required' => false))
            ->add('adresse', TextType::class,
                array('attr' => array('placeholder' => 'Adresse professionnelle'), 'required' => false))
            ->add('imageFile', FileType::class, array('required' => false))
            ->add('dateNaissance', DateType::class, array(
                'required' => false,
                'widget'   => 'single_text',
                'format'   => 'dd/MM/yyyy',
                'attr'     => array('placeholder' => 'dd/mm/aaaa')
            ))
            ->add('adressePerso', TextType::class,
                array('attr' => array('placeholder' => 'Adresse personnelle'), 'required' => false))
            ->add('tel', TextType::class,
                array('attr' => array('placeholder' => 'Téléphone Pro.'), 'required' => false))
            ->add('telPortable', TextType::class,
                array('attr' => array('placeholder' => 'télpéhone Port.'), 'required' => false))
            ->add('url', TextType::class,
                array('attr' => array('placeholder' => 'Votre site web'), 'required' => false))
            ->add('cv', TextareaType::class, array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('themes', TextareaType::class, array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('responsabilitesScientifiques', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('responsabilitesAdministratives', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('valorisation', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('vulgarisation', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('international', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('enseignements', TextareaType::class,
                array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('evaluation', TextareaType::class, array('attr' => array('class' => 'tinyMCE'), 'required' => false))
            ->add('editorial', TextareaType::class, array('attr' => array('class' => 'tinyMCE'), 'required' => false));
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
