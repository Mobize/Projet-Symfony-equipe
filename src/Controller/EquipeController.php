<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


 /**
  * @Route("/equipes")
  */
class EquipeController extends Controller
{
   /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('equipe/index.html.twig', [
            
        ]);
    }
}
