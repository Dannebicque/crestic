<?php

namespace AppBundle\Form;

use AppBundle\Entity\PublicationsConferences;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;use Symfony\Component\Form\FormBuilderInterface;
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
            ->add('comiteLecture', CheckboxType::class, array('label' => 'Conférence avec comité de lecture'))
            ->add('acte', CheckboxType::class, array('label' => 'Conférence avec actes'))
            ->add('invite', CheckboxType::class, array('label' => 'Session invitée'))
            ->add('poster', CheckboxType::class, array('label' => 'Session Poster'))
            ->add('isbn', TextType::class, array('label' => 'ISBN', 'required' => false))
            ->add('conference', EntityType::class, array('class' => 'AppBundle\Entity\Conferences', 'choice_label' => 'nomConference', 'label' => 'Conférence'));

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
