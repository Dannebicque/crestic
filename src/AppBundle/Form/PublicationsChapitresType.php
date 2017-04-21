<?php

namespace AppBundle\Form;

use AppBundle\Entity\PublicationsChapitres;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationsChapitresType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titreOuvrage', TextType::class, array('label' => 'Titre de l\'ouvrage'))
            ->add('typeOuvrage', TextareaType::class, array('label' => 'Type d\'ouvrage', 'required' => false))
            ->add('serie', TextType::class, array('label' => 'Série', 'required' => false))
            ->add('isbn', TextType::class, array('label' => 'ISBN', 'required' => false))
            ->add('redacteurChef', TextType::class, array('label' => 'Rédacteur en chef', 'required' => false))
            ->add('vulgarisation', CheckboxType::class, array('label' => 'Chapitre de culgarisation'))
            ->add('editeur', EntityType::class, array('class' => 'AppBundle\Entity\Editeurs', 'choice_label' => 'nom', 'label' => 'Editeur'));

        $builder->add('bar', PublicationsType::class, array(
            'data_class' => PublicationsChapitres::class,
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\PublicationsChapitres'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_publicationschapitres';
    }


}
