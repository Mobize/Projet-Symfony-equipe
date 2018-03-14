<?php

namespace App\Controller\Admin;

use App\Entity\Club;
use App\Form\ClubType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/club")
 * Toutes les routes vont être pré&fixées par /admin du fait de l'inscription
 * 'admin' dans le fichier annotations.yaml
 */
class ClubController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Club::class);
        //on recup ttes les catégories
        $clubs = $repository->findAll();
        
        return $this->render('admin/club/index.html.twig', [
            'clubs' => $clubs
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
            $club = new Club();
        } else {
            $club = $em->getRepository(Club::class)->find($id);
        }        
        
        //création du formulaire lié à la catégorie
        $form = $this->createForm(ClubType::class, $club);
        
        //le formulaire traite la requete HTTP
        $form->handleRequest($request);
        
        //si le formulaire à été envoyé
        if ($form->isSubmitted()){
            //s'il n'y à pas d'erreurs de validation du formulaire
            if ($form->isValid()){
                //prepare l'enregistrement en bdd
                $em->persist($club);
                //fait l'enregistrement en bdd
                $em->flush();
                
                //Ajout du message flash
                $this->addFlash('success', 'Le club '.$club->getNom().' a été enregistré');
                //redirection vers la liste
                return $this->redirectToRoute('app_admin_club');                
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }
        
         return $this->render('admin/club/edit.html.twig', 
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
        //racourci pour $em->getRepository(Club::class)->find($id)
        $category = $em->find(Club::class, $id);
        
        //suppression de la categorie en bdd
        $em->remove($club);
        $em->flush();
        
        //ajout d'un message
        $this->addFlash('success', 'Le club a été supprimée');
        //redirection vers la liste des categories
        return $this->redirectToRoute('app_admin_club');
        
    }
}
