<?php

namespace App\Controller\Admin;

use App\Entity\Club;
use App\Form\ClubType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
        
        // tentative gestion image---1 
        $originalImage = null;
        // fin tentative--1
        
        if(is_null($id) ) {
            $club = new Club();
        } else {
            $club = $em->getRepository(Club::class)->find($id);
            
            //tentative gestion image --2
            if (!is_null($club->getLogo()) ) {
                $originalImage = $club->getLogo();
                $imagePath = $this->getParameter('upload_dir') . '/' . $originalImage;
                // objet File pour éviter une erreur du formulaire
                $club->setLogo(new File($imagePath)); //fin tentative --2
            }
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
                
                //tentative gestion image--3
                /** @var UploadedFile $image */
                $image = $club->getLogo();
                
                 // s'il y a une image uploadée
                if (!is_null($image)) {
                    // nom du fichier que l'on va enregistrer
                    $filename = uniqid() . '.' . $image->guessExtension();
                    
                    // équivalent move_uploaded_file()
                    $image->move(
                        // upload_dir défini dans service.yaml
                        $this->getParameter('upload_dir'),
                        $filename
                    );
                    
                    $club->setLogo($filename);
                    
                    // suppression de l'ancienne image en modification
                    if (!is_null($originalImage)) {
                        unlink($this->getParameter('upload_dir') . '/' . $originalImage);
                    }
                } else {
                    // getData sur une checkbox = true si cochée, false sinon
                    if ($form->has('remove_logo') && $form->get('remove_logo')->getData()) {
                        $club->setLogo(null);
                        unlink($this->getParameter('upload_dir') . '/' . $originalImage);
                    } else {
                        $club->setLogo($originalImage);
                    }
                }
                // fin tentative 3
                
                $em->persist($club);
                //fait l'enregistrement en bdd
                $em->flush();
                
                //Ajout du message flash
                $this->addFlash('success', 'Le club '.$club->getNom().' a été enregistré');
                //redirection vers la liste
                return $this->redirectToRoute('app_admin_club_index');                
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }
        
        $nom = $club->getNom();
        return $this->render('admin/club/edit.html.twig', 
                 [
                     'form' => $form->createView(),
                     'nom' => $nom
                 ]
        );
    }
    
    
    /**
     * @Route("/delete/{id}")
     * @param int $id
     */
    public function delete($id)
    {
        $club = new Club();
        $em = $this->getDoctrine()->getManager();
        //racourci pour $em->getRepository(Club::class)->find($id)
        $club = $em->find(Club::class, $id);
        
        //suppression de la categorie en bdd
        $em->remove($club);
        $em->flush();
        
        //ajout d'un message
        $this->addFlash('success', 'Le club a été supprimée');
        //redirection vers la liste des categories
        return $this->redirectToRoute('app_admin_club_index');
        
    }
    
     /**
     * @Route("/profil")
     */
    /*public function profil()
    {
        /*$repository = $this->getDoctrine()->getRepository(Club::class);

        $club = $repository->find
        return $this->render('admin/club/profil.html.twig', 
                 [
                     'club' => $club,
                     
                 ]
        );*/
    //}
}
