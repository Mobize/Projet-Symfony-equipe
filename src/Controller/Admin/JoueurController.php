<?php

namespace App\Controller\Admin;

use App\Entity\Joueur;
use App\Form\JoueurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
* @Route("/joueur")
*/
class JoueurController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Joueur::class);
        
        //on recup ts les joueurs
        $joueurs = $repository->findAll();
        
        return $this->render('admin/joueur/index.html.twig', [
           'joueurs' => $joueurs
        ]);
    }
/**
     * @Route("/edit/{id}", defaults={"id":null})
     */
    public function edit(Request $request,$id)
    {
      
        $em= $this->getDoctrine()->getManager();
        
        if(is_null($id)){
            $joueur = new Joueur();
        } else {
            $joueur = $em->getRepository(Joueur::class)->find($id);
        }        
        
        $form = $this->createForm(JoueurType::class, $joueur);
        
        
        $form->handleRequest($request);
        
        //si le formulaire à été envoyé
        if ($form->isSubmitted()){
            //s'il n'y à pas d'erreurs de validation du formulaire
            if ($form->isValid()){
                //prepare l'enregistrement en bdd
                $em->persist($joueur);
                //fait l'enregistrement en bdd
                $em->flush();
                
                //Ajout du message flash
                $this->addFlash('success', 'Le joueur '.$joueur->getNom().' a été enregistré');
                //redirection vers la liste
                return $this->redirectToRoute('app_admin_joueur_index');                
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }
        
         return $this->render('admin/joueur/edit.html.twig', 
                 [
                     'form' => $form->createView()
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
        $joueur = $em->find(Joueur::class, $id);

        $em->remove($joueur);
        $em->flush();
        
        //ajout d'un message
        $this->addFlash('success', 'Le joueur a été supprimée');
        //redirection vers la liste 
        return $this->redirectToRoute('app_admin_joueur_index');
        
    }    
}
