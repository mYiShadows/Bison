<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin")
 */
class ProjetAdminController extends AbstractController
{
    /**
     * @Route("/projet", name="projet_admin")
     */
    public function index()
    {
        $projets = $this->getDoctrine()
            ->getRepository(Projet::class)
            ->findBy([], ["titreProjet" => "ASC"]);

        return $this->render('projet_admin/list_projet.html.twig', [
            'projets' => $projets,
        ]);
    }

    /**
     * @Route("/add_projet", name="projet_add")
     * @Route("/{id}/edit_projet", name="projet_edit")
     */
    public function add_edit_projet(Projet $projet = null, Request $request) {
        // si le projet n'existe pas, on instancie un nouveau Article (on est dans le cas d'un ajout )
        if(!$projet){
            $projet = new Projet();
        }

        // il faut créer un ProjetType au préalable (php bin/console make:form)
        $form = $this->createForm(ProjetType::class, $projet);

        $form->handleRequest($request);
        //si on soumet le formulaire et que le form est valide
        if($form->isSubmitted() && $form->isValid()) {
            // on récupère les données du formulaire
            $projet = $form->getData();
            // on ajoute le nouveau projet
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($projet);
            $entityManager->flush();
            // on redirige vers la liste des projets(projet_list étant le nom de la route qui liste tous les projets dans ProjetController)
            return $this->redirectToRoute('projet_admin');
        }

        /* on renvoie à la vue correspondante :
            - le formulaire
            - le booléen editMode (si vrai, on est dans le cas d'une édition sinon on est dans le cas d'un ajout)
         */
        return $this->render('projet_admin/add_edit.html.twig', [
            'formProjet' => $form->createView(),
            'editMode' => $projet->getId() !== null
        ]);
    }

    /**
     * @Route("/{id}/delete_projet", name="projet_delete") 
     */
    public function delete_projet(Projet $projet)
    {
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($projet);
        $entityManager->flush();
        
        return $this->redirectToRoute('projet_admin');

    }


}
