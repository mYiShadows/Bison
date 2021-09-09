<?php

namespace App\Controller;

use App\Entity\AcceuilCarousel;
use App\Form\AcceuilCarouselType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilCarouselController extends AbstractController
{
     /**
     * @Route("acceuil", name="acceuil_index")
     */
    public function index()
    {
        $acceuils = $this->getDoctrine()
            ->getRepository(AcceuilCarousel::class)
            ->findBy([], ["image" => "DESC"]);

        return $this->render('acceuil/index.html.twig', [
            'acceuils' => $acceuils,
        ]);
    }

}