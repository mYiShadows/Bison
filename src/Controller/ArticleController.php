<?php

namespace App\Controller;


use App\Entity\Article;
use App\Form\ArticleType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/articles")
 */
class ArticleController extends AbstractController
{
     /**
     * @Route("/", name="articles_index")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        // $articles = $this->getDoctrine()
        //     ->getRepository(Article::class)
        //     ->findBy([], ["createdAt" => "DESC"]);

        $pagination = $paginator->paginate(                 /* Decoupage de la page */
            $this->getDoctrine()->getRepository(Article::class)->findAllPaginate(), /* Requete DQL avec l'entité Article */
            $request->query->getInt("page", 1),             /* 1er page = 1, limite article par page = 9 */
            9
        );


        return $this->render('article/index.html.twig', [   /* Rendu de la pagination après decoupage de l'entité article */
            'pagination' => $pagination,
        ]);
    }

    
    
    /**
     * @Route("/{id}", name="article_show", methods="GET")
     */
    public function show(Article $article): Response {
        return $this->render('article/show.html.twig',[
            'article' => $article
        ]);
    }
}