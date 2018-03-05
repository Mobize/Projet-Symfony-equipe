<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


class SecurityController extends Controller
{
    /**
     * @Route("/inscription")
     */
    public function register()
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        
        return $this->render('security/register.html.twig', 
            [
                'form' => $form->createView()
            ]
        );
    }
}
