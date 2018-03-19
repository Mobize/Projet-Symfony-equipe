<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\Saison;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


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
        //Récupération du nom de la dernière saison enregistrée pour le club
        $SaisonClubRepository = $this->getDoctrine()->getRepository(Saison::class);
        $NomderniereSaisonClub = $SaisonClubRepository->findNomLatestSaison($this->getUser()->getClub()->getId());
        $IdDerniereSaisonClub = $SaisonClubRepository->findIdLatestSaison($this->getUser()->getClub()->getId());
             
        //Récupération de la liste des équipes du club de la dernière saison
        $equipesSaisonClubRepository = $this->getDoctrine()->getRepository(Equipe::class);
        $listEquipes = $equipesSaisonClubRepository->listEquipesSaisonClub(
                $this->getUser()->getClub()->getId(),
                $IdDerniereSaisonClub
        );
        
        return $this->render('equipes/index.html.twig', [
            'NomderniereSaisonClub' => $NomderniereSaisonClub,
            'listEquipes' => $listEquipes
        ]);
    }
}