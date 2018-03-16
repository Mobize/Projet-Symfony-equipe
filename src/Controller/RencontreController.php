<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RencontreController extends Controller
{
    /**
     * @Route("/rencontre", name="rencontre")
     */
    public function index()
    {
        return $this->render('rencontre/index.html.twig', [
            'controller_name' => 'RencontreController',
        ]);
    }
}
