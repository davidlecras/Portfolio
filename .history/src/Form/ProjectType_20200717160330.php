<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('imageFile', FileType::class, [
            'label' => 'Ajouter une image'
        ])
        ->add('title', TextType::class, [
            'label' => "Nom du projet"
        ])
        ->add('URL', UrlType::class, ['attr' => [
            'placeholder' => 'https://example.com'
        ]])
        ->add('description', TextareaType::class, [
            'label' => "Description du projet",
            'attr' => ['rows' => 8]
        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
