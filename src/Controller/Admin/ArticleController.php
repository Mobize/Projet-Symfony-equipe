<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        
        //on recup ttes les catégories
        $articles = $repository->findAll();
        
        return $this->render('admin/article/index.html.twig', 
            [
                'articles' => $articles
            ]
        );
    }
    
    /**
     * @Route("/edit/{id}", defaults={"id": null})
     */
        public function edit(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        if (is_null($id)){//création
            $article = new Article();
            //l'auteur de l'article est l'utilisateur connecté
            $article->setAuthor($this->getUser());
        }else{//modification
            $article = $em->find(Article::class, $id);            
        }
        
        $form = $this->createForm(ArticleType::class, $article);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted()){
            if ($form->isValid()){
                //prepare l'enregistrement en bdd
                $em->persist($article);
                //fait l'enregistrement en bdd
                $em->flush();
                
                //Ajout du message flash
                $this->addFlash('success', 'L\'article '.$article->getTitle().' a été enregistré');
                //redirection vers la liste
                return $this->redirectToRoute('app_admin_article_index');
            }else{
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }
        
        return $this->render(
            '/admin/article/edit.html.twig', 
            [
                'form' => $form->createView()    
            ]
        );
    }
}
