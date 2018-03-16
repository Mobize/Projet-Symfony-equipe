<?php

namespace App\Controller;

use App\Entity\Club;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;



class IndexController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        if($this->getUser()){
          $nomClub = $this->getUser()->getClub()->getNom();  
        } else {
            $nomClub ='';
        }
        
        
           
        return $this->render(
                'index/index.html.twig',
                [
                  'nomClub' => $nomClub  
                ]
        );
    }
    

}
