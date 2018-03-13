<?php

namespace App\Controller\Admin;

use App\Entity\Rencontre;
use App\Form\RencontreType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rencontre")
 */
class RencontreController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
        {
        $repository = $this->getDoctrine()->getRepository(Rencontre::class);
        
        //on recup ts les matchs
        $rencontres = $repository->findAll();
        
        return $this->render(
            'admin/rencontre/index.html.twig', [
            'rencontres' => $rencontres
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
            $rencontre= new Rencontre();
            
        } else {
            $rencontre = $em->getRepository(Rencontre::class)->find($id);
        }        
        
        //création du formulaire lié à l'équipe
        $form = $this->createForm(RencontreType::class, $rencontre);
        
        //le formulaire traite la requete HTTP
        $form->handleRequest($request);
        
        //si le formulaire à été envoyé
        if ($form->isSubmitted()){
            //s'il n'y à pas d'erreurs de validation du formulaire
            if ($form->isValid()){
                //prepare l'enregistrement en bdd
                $em->persist($rencontre);
                //fait l'enregistrement en bdd
                $em->flush();
                
                //Ajout du message flash
                $this->addFlash('success', 'La rencontre a été enregistrée');
                //redirection vers la liste
                return $this->redirectToRoute('app_admin_rencontre_index');                
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }
        
         return $this->render('admin/rencontre/edit.html.twig', 
                 [
                     'form' => $form->createView()
                 ]
        );
    }
    
}