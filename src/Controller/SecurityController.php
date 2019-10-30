<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="security")
     */
    public function index()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }
    /**
     * @Route("/login", name="connect_login")
     */
    public function loginAction()
    {
        return $this->render('security/login.html.twig', array(
           
        ));
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        
    }
}
