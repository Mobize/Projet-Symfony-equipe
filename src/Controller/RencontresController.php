<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class RencontresController extends Controller
{
    /**
     * @Route("/rencontres", name="rencontres")
     */
    public function index()
    {
    /*
     * partie de recuperation des données en suspens pour tests
     $repository = $this->getDoctrine()->getRepository(Rencontres::class);
        //on recup ttes les rencontres
        $rencontres = $repository->findAll();  
     * 
    */    
        return $this->render('rencontres/index.html.twig', [
            'controller_name' => 'rencontres'
        ]);
    }
    
}
