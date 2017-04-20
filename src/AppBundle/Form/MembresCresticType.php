<?php

namespace AppBundle\Form;

use Genemu\Bundle\FormBundle\Form\JQuery\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembresCresticType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('disciplinehceres')
            ->add('hdr')
            ->add('datenomination', \Symfony\Component\Form\Extension\Core\Type\DateType::class)
            ->add('corpsgrade')
            ->add('nom')
            ->add('prenom')
            ->add('role')
            ->add('cnu')
            ->add('status')
            ->add('site')
            ->add('batiment')
            ->add('etage')
            ->add('bureau')
            ->add('emailPerso')
            ->add('adresse')
            ->add('image')
            ->add('dateNaissance',\Symfony\Component\Form\Extension\Core\Type\DateType::class)
            ->add('adressePerso')
            ->add('tel')
            ->add('telPortable')
            ->add('url')
            ->add('cv')
            ->add('themes')
            ->add('responsabilitesScientifiques')
            ->add('responsabilitesAdministratives')
            ->add('valorisation')
            ->add('vulgarisation')
            ->add('international')
            ->add('membreAssocie')
            ->add('membreConseilLabo')
            ->add('enseignements')
            ->add('responsabiliteFonction')
            ->add('ancienMembresCrestic')
            ;
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
