<?php

namespace AppBundle\Form;

use AppBundle\Entity\Publications;
use AppBundle\Entity\PublicationsRevues;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationsRevuesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('volume', TextType::class, array('label' => 'Volume', 'required' => false))
            ->add('numero', TextType::class, array('label' => 'Numéro', 'required' => false))
            ->add('comiteLecture', CheckboxType::class, array('label' => 'Avec Comité de lecture', 'required' => false, 'data' => true))
            ->add('vulgarisation', CheckboxType::class, array('label' => 'Revue de vulgarisation', 'required' => false))
            ->add('editorial', CheckboxType::class, array('label' => 'Contribution editoriale', 'required' => false))
            ->add('issn',TextType::class, array('label' => 'Numéro ISSN', 'required' => false))
            ->add('specialIssue',TextType::class, array('label' => 'Numéro spécial', 'required' => false))
            ->add('redacteurChef',TextType::class, array('label' => 'Rédacteur en chef', 'required' => false))
            ->add('revue', EntityType::class, array('class' => 'AppBundle\Entity\Revues', 'choice_label' => 'titreRevue', 'label' => 'Titre de la revue'))
            ->add('editeur', EntityType::class, array('class' => 'AppBundle\Entity\Editeurs', 'choice_label' => 'nom', 'label' => 'Editeur', 'required' => false));

        $builder->add('bar', PublicationsType::class, array(
            'data_class' => PublicationsRevues::class,
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\PublicationsRevues'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_publicationsrevues';
    }


}
