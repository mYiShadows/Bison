<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'attr' => [
                    'placeholder' => "Title of article"
                ], 'label_format' => 'Title :'
            ])
            ->add('url', TextType::class, [
                'attr' => [
                    'placeholder' => "Url of image"
                ], 'label_format' => 'Image of article :'
            ])
            ->add('annee', TextType::class, [
                'attr' => [
                    'placeholder' => "Year"
                ], 'label_format' => 'Year of creation :'
            ])
            ->add('location', TextType::class, [
                'attr' => [
                    'placeholder' => "From"
                ], 'label_format' => 'PLACE OF ORDER :'
            ])
            ->add('client', TextType::class, [
                'attr' => [
                    'placeholder' => "Client"
                ], 'label_format' => 'Name Client :'
            ])
            ->add('createur', TextType::class, [
                'attr' => [
                    'placeholder' => "Creator"
                ], 'label_format' => 'Name Creator :'
            ]) 
            ->add('createdAt', DateType::class, [
                'label_format' => 'Date de mise en ligne :'
            ])
            ->add('Send', SubmitType::class, [
                'attr' => ['class' => 'btn-register'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
