<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin")
 */
class ProfilAdminController extends AbstractController
{
    /**
     * @Route("/profil/admin", name="profil_admin")
     */
    public function index()
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findBy([], ["name" => "DESC"]);

        return $this->render('profil_admin/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/{id}/delete_user", name="user_delete") 
     */
    public function delete_projet(User $user)
    {
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();
        
        return $this->redirectToRoute('profil_admin');

    }
}
