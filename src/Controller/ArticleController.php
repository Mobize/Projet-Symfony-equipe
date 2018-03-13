<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * @Route("/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route("{id}")
     */
    public function index(Article $article)
    {
        return $this->render('article/index.html.twig', 
        [
            'article' => $article
        ]);
    }
}
