<?php

namespace App\Controller;

use App\Entity\Equipe;
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
        $equipeRepository = $this->getDoctrine()->getRepository(Equipe::class);
        $equipes = $equipeRepository->listEquipeClub($this->getUser()->getClub()->getId());
        
        return $this->render('equipes/index.html.twig', [
            'equipes' => $equipes,
        ]);
    }
}
