<?php

namespace App\Controller\Admin;

use App\Entity\Joueur;
use App\Form\JoueurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
          // tentative gestion image---1 
        $originalImage = null;
        // fin tentative--1

        if(is_null($id)){
            $joueur = new Joueur();
        } else {
            $joueur = $em->getRepository(Joueur::class)->find($id);
          //tentative gestion image --2
            if (!is_null($joueur->getImage()) ) {
                $originalImage = $joueur->getImage();
                $imagePath = $this->getParameter('upload_dir') . '/' . $originalImage;
                // objet File pour éviter une erreur du formulaire
                $joueur->setImage(new File($imagePath)); //fin tentative --2
            }  
        }        
          // tentative gestion PDF---1 
        $originalFile = null;
        // fin tentative--1
        
        if(is_null($id)){
            $joueur = new Joueur();
        } else {
            $joueur = $em->getRepository(Joueur::class)->find($id);
          //tentative gestion PDF --2
            if (!is_null($joueur->getCertificat()) ) {
                $originalFile = $joueur->getCertificat();
                $filePath = $this->getParameter('upload_dir') . '/' . $originalFile;
                // objet File pour éviter une erreur du formulaire
                $joueur->setCertificat(new File($filePath)); //fin tentative --2
            }  
        }        
        
        $form = $this->createForm(JoueurType::class, $joueur);
        
        
        $form->handleRequest($request);
        
        //si le formulaire à été envoyé
        if ($form->isSubmitted()){
            //s'il n'y à pas d'erreurs de validation du formulaire
            if ($form->isValid()){
                //prepare l'enregistrement en bdd
             //tentative gestion PDF--3
                /** @var UploadedFile $certificat */
                $certificat = $joueur->getCertificat();
                 // s'il y a une image uploadée
                if (!is_null($certificat)) {
                    // nom du fichier que l'on va enregistrer
                    $filename = uniqid() . '.' . $certificat->guessExtension();
                    // équivalent move_uploaded_file()
                    $certificat->move(
                        // upload_dir défini dans service.yaml
                        $this->getParameter('upload_dir'),
                        $filename
                    );
                    
                    $joueur->setCertificat($filename);
                    
                    // suppression de l'ancienne image en modification
                    if (!is_null($originalFile)) {
                        unlink($this->getParameter('upload_dir') . '/' . $originalFile);
                    }
                } 
                // fin tentative 3   
             //tentative gestion image--3
                /** @var UploadedFile $image */
                $image = $joueur->getImage();
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
                    
                    $joueur->setImage($filename);
                    
                    // suppression de l'ancienne image en modification
                    if (!is_null($originalImage)) {
                        unlink($this->getParameter('upload_dir') . '/' . $originalImage);
                    }
                } 
                // fin tentative 3   
   
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
        
        $prenom_nom = $joueur->getPrenom().' '.$joueur->getNom();
        
         return $this->render('admin/joueur/edit.html.twig', 
                 [
                     'form' => $form->createView(),
                     'prenom_nom' => $prenom_nom
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
