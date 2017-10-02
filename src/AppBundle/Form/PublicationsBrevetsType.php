<?php

namespace AppBundle\Form;

use AppBundle\Entity\PublicationsBrevets;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationsBrevetsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateDepot', DateType::class, array('label' => 'Date de dépôt'))
            ->add('numeroDepot', TextType::class, array('label' => 'Numéro de dépôt', 'required' => false))
            ->add('dateDelivrance', DateType::class, array('label' => 'Date de délivrance', 'required' => false))
            ->add('numeroDelivrance', TextType::class, array('label' => 'Numéro de délivrance', 'required' => false))
            ->add('secteur', TextareaType::class, array('label' => 'Secteur', 'required' => false))
            ->add('typeBrevet', ChoiceType::class, array('label' => 'Type de dépôt', 'choices' => array('Brevet' => 'brevet', 'Lettre d\'intention' => 'lettre'), 'expanded' =>true, 'required' => false))
            ->add('pays', EntityType::class, array('class' => 'AppBundle\Entity\Pays', 'choice_label' => 'nomFR', 'label' => 'Pays', 'required' => false));

        $builder->add('bar', PublicationsType::class, array(
            'data_class' => PublicationsBrevets::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\PublicationsBrevets',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_publicationsbrevets';
    }


}
