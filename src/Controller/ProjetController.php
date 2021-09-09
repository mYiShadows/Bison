<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/projets")
 */
class ProjetController extends AbstractController
{
    /**
     * @Route("/", name="projets_index")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        // $articles = $this->getDoctrine()
        //     ->getRepository(Projet::class)
        //     ->findBy([], ["createdAt" => "DESC"]);

        $pagination = $paginator->paginate(
            $this->getDoctrine()->getRepository(Projet::class)->findAllPaginate(),
            $request->query->getInt("page", 1),
            6
        );


        return $this->render('projet/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /* Dropdown list "Projets" in Menu navbar link to menu.html.twig */

    public function menu()
    {
        $projets = $this->getDoctrine()
            ->getRepository(Projet::class)
            ->findBy([], ["anneeProjet" => "DESC"]);

        return $this->render('menu.html.twig', [
            'projets' => $projets,
        ]);
    }

    /**
     * @Route("/{id}", name="projet_show", methods="GET")
     */
    public function show(Projet $projet): Response {
        return $this->render('projet/show.html.twig',[
            'projet' => $projet
        ]);
    }

}
