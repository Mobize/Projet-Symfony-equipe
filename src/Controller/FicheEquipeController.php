<?php

namespace App\Controller;


use App\Entity\Joueur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/equipe/fiche", defaults={"id":null})
 */
class FicheEquipeController extends Controller
{
    /**
     * @Route("/{id}")
     * @return type
     */
    public function index(Request $request,$id)
    {
        $em= $this->getDoctrine()->getManager();
        
        $joueurs = $em->getRepository(Joueur::class )->find($id);
        
        return $this->render('fiche_equipe/index.html.twig', [
            
            'joueurs' => $joueurs    
        ]);
    }
}
