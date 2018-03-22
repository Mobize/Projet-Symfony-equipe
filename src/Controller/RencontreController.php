<?php

namespace App\Controller;
use App\Entity\Saison;
use App\Entity\Rencontre;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/rencontre")
 */
class RencontreController extends Controller
{
        /**
        * @Route("/{id}")
        * @return type
        */
         public function index($id)
        {

                //Récupération du nom de la dernière saison enregistrée pour le club
                $SaisonClubRepository = $this->getDoctrine()->getRepository(Saison::class);
                $NomderniereSaisonClub = $SaisonClubRepository->findNomLatestSaison($this->getUser()->getClub()->getId());
                $IdDerniereSaisonClub = $SaisonClubRepository->findIdLatestSaison($this->getUser()->getClub()->getId());

                //$em= $this->getDoctrine()->getRepository(Rencontre::class);

                $rencontre = $this->getDoctrine()->getRepository(Rencontre::class )->find($id);

                dump($rencontre);
                return $this->render('rencontre/index.html.twig', [
                    'rencontre' => $rencontre,
                    'NomderniereSaisonClub' => $NomderniereSaisonClub,
                ]);
}}