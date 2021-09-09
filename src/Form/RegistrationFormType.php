<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class , [
                'attr' => ['placeholder' => "E-mail Address"], 
                'label_format' => 'Email :'
            ])
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password :', 'attr' => ['placeholder' => "Your Password"]],
                'second_options' => ['label' => 'Repeat Password :', 'attr' => ['placeholder' => "Repeat Password"] ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a Password',
                    ]),
                    new Length([
                        'min' => 6,
                        // minimum de caractère imposer par Symfony
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // maximum de caractère imposer pour la sécurité de Symfony
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('fname', TextType::class , [
                'attr' => ['placeholder' => "Your First Name"], 
                'label_format' => 'First Name :',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your First Name',
                    ]),
                    new Length([
                        'min' => 2,
                        // minimum de caractère imposer par Symfony
                        'minMessage' => 'Your first name should be at least {{ limit }} characters',
                        // maximum de caractère imposer pour la sécurité de Symfony
                        'max' => 20,
                        'maxMessage' => 'your first name must contain a maximum of {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('name', TextType::class , [
                'attr' => ['placeholder' => "Your Name"], 
                'label_format' => 'Name :',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a Name',
                    ]),
                    new Length([
                        'min' => 2,
                        // minimum de caractère imposer par Symfony
                        'minMessage' => 'Your name should be at least {{ limit }} characters',
                        // maximum de caractère imposer pour la sécurité de Symfony
                        'max' => 20,
                        'maxMessage' => 'Your name must contain a maximum of {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('adress', TextType::class , [
                'attr' => ['placeholder' => "Your Address"], 
                'label_format' => 'Address :',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your Adress',
                    ]),
                    new Length([
                        'min' => 10,
                        // minimum de caractère imposer par Symfony
                        'minMessage' => 'Your adress should be at least {{ limit }} characters',
                        // maximum de caractère imposer pour la sécurité de Symfony
                        'max' => 30,
                        'maxMessage' => 'your adress must contain a maximum of {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('city', TextType::class , [
                'attr' => ['placeholder' => "Your City"], 
                'label_format' => 'City :',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your City',
                    ]),
                    new Length([
                        'min' => 10,
                        // minimum de caractère imposer par Symfony
                        'minMessage' => 'Your adress should be at least {{ limit }} characters',
                        // maximum de caractère imposer pour la sécurité de Symfony
                        'max' => 30,
                        'maxMessage' => 'your adress must contain a maximum of {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('zipcode', NumberType::class , [
                'attr' => ['placeholder' => "Your Zip Code"], 
                'label_format' => 'Zip Code :',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your Zip Code',
                    ]),
                    new Length([
                        'min' => 5,
                        // minimum de caractère imposer par Symfony
                        'minMessage' => 'Your zip code should be at least {{ limit }} characters',
                        // maximum de caractère imposer pour la sécurité de Symfony
                        'max' => 12,
                        'maxMessage' => 'your zip code must contain a maximum of {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('number', NumberType::class , [
                'attr' => ['placeholder' => "Your Number"], 
                'label_format' => 'Number :',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter Number',
                    ]),
                    new Length([
                        'min' => 8,
                        // minimum de caractère imposer par Symfony
                        'minMessage' => 'Your number should be at least {{ limit }} characters',
                        // maximum de caractère imposer pour la sécurité de Symfony
                        'max' => 16,
                        'maxMessage' => 'your number must contain a maximum of {{ limit }} characters',
                    ]),
                ],
            ])

            // ->add('agreeTerms', CheckboxType::class, [
            //     'mapped' => false,
            //     'constraints' => [
            //         new IsTrue([
            //             'message' => 'You should agree to our terms.',
            //         ]),
            //     ],
            // ])
            
            ->add('Send', SubmitType::class, [
                'attr' => ['class' => 'btn-register'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
