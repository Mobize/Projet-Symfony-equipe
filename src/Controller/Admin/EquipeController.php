<?php

namespace App\Controller\Admin;

use App\Entity\Saison;
use App\Entity\Equipe;
use App\Form\EquipeType;
use Symfony\Component\HttpFoundation\File\File;
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
        
        if(!is_null($this->getUser())){
            $saisonRepository = $this->getDoctrine()->getRepository(Saison::class);
            $saisons = $saisonRepository->listSaisonClub($this->getUser()->getClub()->getId());
            $nbsaison = count($saisons);
            
            //dump($nbsaison);
        } else {
            $nbsaison = 0;
        }
       
      
        
        
        return $this->render('admin/equipe/index.html.twig', [
               'equipes' => $equipes,
               'equipeExts' => $equipeExts,
                'nbsaisons' => $nbsaison
               
        ]);
    }
 
     /**
     * @Route("/edit/{id}", defaults={"id":null})
     */
    public function edit(Request $request,$id)
    {
        $em= $this->getDoctrine()->getManager();
        $originalImage = null;
        
        if(is_null($id)){
            $equipe = new Equipe();
            
        } else {
            $equipe = $em->getRepository(Equipe::class)->find($id);
            
            if (!is_null($equipe->getImage())) {
                $originalImage = $equipe->getImage();
                $imagePath = $this->getParameter('upload_dir') . '/' . $originalImage;
                // objet File pour éviter une erreur du formulaire
                $equipe->setImage(new File($imagePath));
            }
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
                
                /** @var UploadedFile $image */
                $image = $equipe->getImage();
                
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
                    
                    $equipe->setImage($filename);
                    
                    // suppression de l'ancienne image en modification
                    if (!is_null($originalImage)) {
                        unlink($this->getParameter('upload_dir') . '/' . $originalImage);
                    }
                } else {
                    // getData sur une checkbox = true si cochée, false sinon
                    if ($form->has('remove_image') && $form->get('remove_image')->getData()) {
                        $equipe->setImage(null);
                        unlink($this->getParameter('upload_dir') . '/' . $originalImage);
                    } else {
                        $equipe->setImage($originalImage);
                    }
                }
                
                //prepare l'enregistrement en bdd
                $em->persist($equipe);
                //fait l'enregistrement en bdd
                $em->flush();
                
                //Ajout du message flash
                $this->addFlash('success', 'L\'équipe '.$equipe->getNom().' a été enregistrée, veuillez ajouter vos joueurs');
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
