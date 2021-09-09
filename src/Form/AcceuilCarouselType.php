<?php

namespace App\Form;

use App\Entity\AcceuilCarousel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AcceuilCarouselType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'attr' => [
                    'placeholder' => "Title Image"
                ], 'label_format' => 'Title :'
            ])
            ->add('image', TextType::class, [
                'attr' => [
                    'placeholder' => "Url of Image"
                ], 'label_format' => 'Image :'
            ])
            ->add('Send', SubmitType::class, [
                'attr' => ['class' => 'btn-register'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AcceuilCarousel::class,
        ]);
    }
}
