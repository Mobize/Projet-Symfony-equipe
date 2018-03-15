<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;



class IndexController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        $articleRepository= $this->getDoctrine()->getRepository(Article::class);
        // méthode addSelect écrite dans App\Repository\ArticleRepository
        $articles = $articleRepository->addSelect($select = null);
        
        return $this->render(
                'index/index.html.twig',
                [
                    'articles' => $articles
                ]
        );
    }
}
