<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Repository\EntrepriseRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(EntrepriseRepository $entrepriseRepository)
    {
        $IsExisteEntreprise = $this->getDoctrine()->getRepository(Entreprise::class)->findAll();

        if ($IsExisteEntreprise==null) {
            return $this->redirectToRoute('entreprise_new');
        }

        return $this->render('default/index.html.twig', [
            'entreprises' => $entrepriseRepository->findAll(), 
        ]);
    }

}
