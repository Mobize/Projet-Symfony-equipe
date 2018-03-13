<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    /**
     * @Route("/contact")
     */
    public function index()
    {
        return $this->render('contact/index.html.twig', [
            
        ]);
    }
}
