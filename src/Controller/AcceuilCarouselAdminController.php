<?php

namespace App\Controller;

use App\Entity\AcceuilCarousel;
use App\Form\AcceuilCarouselType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/admin")
 */
class AcceuilCarouselAdminController extends AbstractController
{
    /**
     * @Route("acceuil", name="acceuil_admin")
     * retourne les images du Carousel de la page Home
     */
    public function index()
    {
        $acceuils = $this->getDoctrine()
            ->getRepository(AcceuilCarousel::class)
            ->findBy([], ["image" => "DESC"]);

        return $this->render('acceuil_admin/list_acceuil.html.twig', [
            'acceuils' => $acceuils,
        ]);
    }
    
    /**
     * @Route("/add_acceuil", name="acceuil_add")
     * @Route("/{id}/edit_acceuil", name="acceuil_edit")
     */
    public function add_edit_acceuil(AcceuilCarousel $acceuil = null, Request $request) {
        // si l'image n'existe pas, on instancie une nouvelle image (on est dans le cas d'un ajout )
        if(!$acceuil){
            $acceuil = new AcceuilCarousel();
        }

        // il faut créer un AcceuilCarouselType au préalable (php bin/console make:form)
        $form = $this->createForm(AcceuilCarouselType::class, $acceuil);

        $form->handleRequest($request);
        //si on soumet le formulaire et que le form est valide
        if($form->isSubmitted() && $form->isValid()) {
            // on récupère les données du formulaire
            $acceuil = $form->getData();
            // on ajoute le nouveau article
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($acceuil);
            $entityManager->flush();
            // on redirige vers la liste des images (image_list étant le nom de la route qui liste tous les images dans AcceuilController)
            return $this->redirectToRoute('acceuil_admin');
        }

        /* on renvoie à la vue correspondante :
            - le formulaire
            - le booléen editMode (si vrai, on est dans le cas d'une édition sinon on est dans le cas d'un ajout)
         */
        return $this->render('acceuil_admin/add_edit.html.twig', [
            'formAcceuil' => $form->createView(),
            'editMode' => $acceuil->getId() !== null
        ]);
    }

    /**
     * @Route("/{id}/delete_acceuil", name="acceuil_delete") 
     */
    public function delete_acceuil(Acceuil $acceuil)
    {
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($acceuil);
        $entityManager->flush();
        
        return $this->redirectToRoute('acceuil_admin');

    }
}
