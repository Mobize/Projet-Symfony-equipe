<?php

namespace App\Controller;

use App\Entity\Club;
use App\Entity\Rencontre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rencontres/{id}", defaults={"id": null})
 */
class RencontresController extends Controller
{
    /**
     * @Route("/")
     */
    public function index(Request $request,$id)
    {
     
     $repository = $this->getDoctrine()->getRepository(Rencontre::class);
        // recup des rencontres
        $rencontres = $repository->findAll();
        
       /* $Clubrepository = $this->getDoctrine()->getRepository(Club::class);
        //recup des clubs
        $clubs = $Clubrepository->findAll();
        
        //entity manager gere les objets et les lignes en bdd
        $em= $this->getDoctrine()->getManager();
        
        if(is_null($id) ) {
        $club = new Club();
        } else {
         $club = $em->getRepository(Club::class)->find($id);
         
         if (!is_null($club->getLogo()) ) {
                $originalImage = $club->getLogo();
                $imagePath = $this->getParameter('upload_dir') . '/' . $originalImage;
        } 
         
       
        } // fin else*/
     return $this->render('rencontres/index.html.twig',
         [
            'rencontres' => $rencontres,
           // 'clubs' => $clubs
         ]);
    
        }//fin fonction index
    
} // fin class controller 
