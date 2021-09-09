<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/article", name="article_admin")
     */
    public function index()
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy([], ["titre" => "ASC"]);

        return $this->render('article_admin/list_article.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/add_article", name="article_add")
     * @Route("/{id}/edit_article", name="article_edit")
     */
    public function add_edit_article(Article $article = null, Request $request) {
        // si l'article n'existe pas, on instancie un nouveau Article (on est dans le cas d'un ajout )
        if(!$article){
            $article = new Article();
        }

        // il faut créer un ArticleType au préalable (php bin/console make:form)
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        //si on soumet le formulaire et que le form est valide
        if($form->isSubmitted() && $form->isValid()) {
            // on récupère les données du formulaire
            $article = $form->getData();
            // on ajoute le nouveau article
            $entityManager = $this->getDoctrine()->getManager();        // On appelle le Manager
            $entityManager->persist($article);                          // On fais persisté l'entité
            $entityManager->flush();                                    // On push l'entité en tant qu'enregistrement dans la BDD

            $this->addFlash(
                'article',
                'Your article was created or edited with success'
            );

            // on redirige vers la liste des articles (article_admin étant le nom de la route qui liste tous les articles dans ArticleAdminController)
            return $this->redirectToRoute('article_admin');
        }

        /* on renvoie à la vue correspondante :
            - le formulaire
            - le booléen editMode (si vrai, on est dans le cas d'une édition sinon on est dans le cas d'un ajout)
         */
        return $this->render('article_admin/add_edit.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);
    }

    /**
     * @Route("/{id}/delete_article", name="article_delete") 
     */
    public function delete_article(Article $article)
    {
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush();
        
        return $this->redirectToRoute('article_admin');

    }
}
