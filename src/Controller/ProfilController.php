<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profile", name="profil")
     */
    public function index()
    {
        $profil = $this->getDoctrine()
            ->getRepository(User::class)
            ->findBy([], ["fname" => "ASC"]);

        return $this->render('profil/index.html.twig', [
            'profil' => $profil,
        ]);
    }
}
