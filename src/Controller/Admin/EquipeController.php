<?php

namespace App\Controller\Admin;

use App\Entity\Equipe;
use App\Form\EquipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("/equipe")
 */
class EquipeController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
               
        //récupération des équipes du club
        // méthode ListEquipeClub() écrite dans App\Repository\EquipeRepository
        $equipeRepository = $this->getDoctrine()->getRepository(Equipe::class);
        $equipes = $equipeRepository->listEquipeClub($this->getUser()->getClub()->getId());
        
        //récupération des équipes extérieures
        $equipeExts = $equipeRepository->listEquipeClub($this->getUser()->getClub()->getId(),false);
       
        //dump($this->getUser()->getClub()->getId());
        
        return $this->render('admin/equipe/index.html.twig', [
               'equipes' => $equipes,
               'equipeExts' => $equipeExts
               
        ]);
    }
 
     /**
     * @Route("/edit/{id}", defaults={"id":null})
     */
    public function edit(Request $request,$id)
    {
        //entity manager gere les objets et les lignes en bdd
        $em= $this->getDoctrine()->getManager();
        
        if(is_null($id)){
            $equipe = new Equipe();
            
        } else {
            $equipe = $em->getRepository(Equipe::class)->find($id);
           
        }        
        
        //Equipe du club par défaut (pas extérieure)
        $equipe->setLocal(true);
        
        //alimentation de la clé étrangère club
        $equipe->setClub($this->getUser()->getClub());

        
        //création du formulaire lié à l'équipe
        $form = $this->createForm(EquipeType::class, $equipe);
        
        //le formulaire traite la requete HTTP
        $form->handleRequest($request);
        
        //si le formulaire à été envoyé
        if ($form->isSubmitted()){
            //s'il n'y à pas d'erreurs de validation du formulaire
            if ($form->isValid()){
                //prepare l'enregistrement en bdd
                $em->persist($equipe);
                //fait l'enregistrement en bdd
                $em->flush();
                
                //Ajout du message flash
                $this->addFlash('success', 'L\équipe '.$equipe->getNom().' a été enregistrée');
                //redirection vers la liste
                return $this->redirectToRoute('app_admin_equipe_index');                
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }
        
        $nom = $equipe->getNom();
        $typeEquipe = $equipe->getLocal();
        if($typeEquipe == 1){
            $lib_Equipe = ' du club ';
        } else {
            $lib_Equipe = ' extérieure ';
        }
        
         return $this->render('admin/equipe/edit.html.twig', 
                 [
                     'form' => $form->createView(),
                     'nom' => $nom,
                     'lib_Equipe' => $lib_Equipe
                 ]
        );
    }
        
    /**
     * @Route("/delete/{id}")
     * @param int $id
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $equipe = $em->find(Equipe::class, $id);
        
        //suppression de la categorie en bdd
        $em->remove($equipe);
        $em->flush();
        
        //ajout d'un message
        $this->addFlash('success', 'L\'équipe a été supprimée');
        //redirection vers la liste des categories
        return $this->redirectToRoute('app_admin_equipe_index');
        
    }
} // {} classe