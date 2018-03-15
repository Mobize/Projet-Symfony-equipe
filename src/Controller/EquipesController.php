<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


 /**
  * @Route("/equipes")
  */
class EquipesController extends Controller
{
   /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('equipes/index.html.twig', [
            
        ]);
    }
}
