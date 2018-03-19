<?php

namespace App\Controller;

use App\Entity\Saison;
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
        
        if(!is_null($this->getUser())){
            $saisonRepository = $this->getDoctrine()->getRepository(Saison::class);
            $saisons = $saisonRepository->listSaisonClub($this->getUser()->getClub()->getId());
            $nbsaison = count($saisons);
            
            //dump($nbsaison);
        } else {
            $nbsaison = 0;
        }
        
        return $this->render('equipes/index.html.twig', [
            'equipes' => $equipes,
            'nbsaisons' => $nbsaison
        ]);
    }
}
