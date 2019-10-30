<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Entreprise;
use App\Entity\UserAccount;
use App\Form\CustomerType;
use App\Form\EntrepriseType;
use App\Form\UserAccountType;
use App\Repository\EntrepriseRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/entreprise")
 */
class EntrepriseController extends AbstractController
{
    /**
     * @Route("/", name="entreprise_index", methods={"GET"})
     */
    public function index(EntrepriseRepository $entrepriseRepository): Response
    {
        return $this->render('entreprise/index.html.twig', [
            'entreprises' => $entrepriseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="entreprise_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $manager): Response
    {
        $customer = new Customer();
        $userAccount = new UserAccount();
        $entreprise = new Entreprise();
        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->handleRequest($request);

        $formCustomer = $this->createForm(CustomerType::class, $customer);
        $formCustomer->handleRequest($request);

        $formUserAccount = $this->createForm(UserAccountType::class, $userAccount);
        $formUserAccount->handleRequest($request);
        $customer->addUserAccount($userAccount);
        if ($form->isSubmitted() || $formCustomer->isSubmitted() || $formUserAccount->isSubmitted()) {
            $hash = $encoder->encodePassword($userAccount, $userAccount->getPassword());

            $file = $entreprise->getLogoEntreprise();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('files_directory_logo'),
                        $fileName
                    );
                } catch (FileException $e) {
                    //throw $th;
                }

                $file = $customer->getCustomerAvatar();
                $fileName1 = md5(uniqid()).'.'.$file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('files_directory_avatar'),
                        $fileName1
                    );
                } catch (FileException $e) {
                    //throw $th;
                }

            $userAccount->setCreatedAt(new \DateTime());
            $userAccount->setIsAdmin(true);
            $userAccount->setLevel(4);
            $userAccount->setPassword($hash);
            $userAccount->setCustomer($customer);

            $entreprise->setLogoEntreprise($fileName);
            $customer->setCustomerAvatar($fileName1);

            $manager->persist($entreprise);
            $manager->persist($customer);
            $manager->persist($userAccount);
            $manager->flush();

            return $this->redirectToRoute('connect_login');
        }

        return $this->render('entreprise/new.html.twig', [
            'entreprise' => $entreprise,
            'form' => $form->createView(),
            'formCustomer' => $formCustomer->createView(),
            'formUserAccount' => $formUserAccount->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="entreprise_show", methods={"GET"})
     */
    public function show(Entreprise $entreprise): Response
    {
        return $this->render('entreprise/show.html.twig', [
            'entreprise' => $entreprise,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="entreprise_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Entreprise $entreprise): Response
    {
        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entreprise_index');
        }

        return $this->render('entreprise/edit.html.twig', [
            'entreprise' => $entreprise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="entreprise_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Entreprise $entreprise): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entreprise->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entreprise);
            $entityManager->flush();
        }

        return $this->redirectToRoute('entreprise_index');
    }
}
