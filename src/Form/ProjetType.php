<?php

namespace App\Form;

use App\Entity\Projet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('titreProjet', TextType::class, [
            'attr' => [
                'placeholder' => "Title of article"
            ], 'label_format' => 'Title :'
        ])
        ->add('imageAffichageProjet', TextType::class, [
            'attr' => [
                'placeholder' => "Url of image"
            ], 'label_format' => 'Image of projet :'
        ])
        ->add('anneeProjet', TextType::class, [
            'attr' => [
                'placeholder' => "Year"
            ], 'label_format' => 'Year of creation :'
        ])
        ->add('locationProjet', TextType::class, [
            'attr' => [
                'placeholder' => "From"
            ], 'label_format' => 'Place of order :'
        ])
        ->add('client', TextType::class, [
            'attr' => [
                'placeholder' => "Client"
            ], 'label_format' => 'Name client :'
        ])
        ->add('createur', TextType::class, [
            'attr' => [
                'placeholder' => "Creator"
            ], 'label_format' => 'Name creator :'
        ])
        ->add('Send', SubmitType::class, [
            'attr' => ['class' => 'btn-register'],
        ]) 
    ;
}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
