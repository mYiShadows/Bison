<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Crée un nouveau User

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);      // Utilise le Form de la class User
        $form->handleRequest($request);                                     // Envoie la requête

        if ($form->isSubmitted() && $form->isValid()) {                     // Si le Form est envoyer et valide
            // Hash the plain password
            $user->setPassword(                                             // Création du Password hasher pour le User
                $passwordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email


            // Add flash message
            $this->addFlash(
                'notice',
                'Your account was created'
            );

            return $this->redirectToRoute('acceuil_index');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
