<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\UserAccount;
use App\Form\UserAccountType;
use App\Repository\EntrepriseRepository;
use App\Repository\UserAccountRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user/account")
 */
class UserAccountController extends AbstractController
{
    /**
     * @Route("/", name="user_account_index", methods={"GET"})
     */
    public function index(UserAccountRepository $userAccountRepository, EntrepriseRepository $entrepriseRepository): Response
    {
        return $this->render('user_account/index.html.twig', [
            'user_accounts' => $userAccountRepository->findAll(),
            'entreprises' => $entrepriseRepository->findAll(), 
        ]);
    }

    /**
     * @Route("/new/{id}/", name="user_account_new", methods={"GET","POST"})
     * @Route("/new/{id}/{username}/", name="user_account_new_edit", methods={"GET","POST"})
     */
    public function new(Request $request, Customer $customer, UserAccount $userAccount=null, UserPasswordEncoderInterface $encoder, EntrepriseRepository $entrepriseRepository): Response
    {
        if (!$userAccount) {
            $userAccount = new UserAccount();
        }
        $form = $this->createForm(UserAccountType::class, $userAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($userAccount, $userAccount->getPassword());
            if ($userAccount->getIsAdmin()==true) {
                $userAccount->setLevel(4);
                $userAccount->setIsAdmin(true);
            }
            $userAccount->setPassword($hash);
            $userAccount->setLevel(0);
            $userAccount->setIsAdmin(false);
            $userAccount->setCreatedAt(new \DateTime());
            $userAccount->setCustomer($customer);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userAccount);
            $entityManager->flush();

            return $this->redirectToRoute('user_account_index');
        }

        return $this->render('user_account/new.html.twig', [
            'user_account' => $userAccount,
            'form' => $form->createView(),
            'entreprises' => $entrepriseRepository->findAll(), 
        ]);
    }

    /**
     * @Route("/{id}", name="user_account_show", methods={"GET"})
     */
    public function show(UserAccount $userAccount, EntrepriseRepository $entrepriseRepository): Response
    {
        return $this->render('user_account/show.html.twig', [
            'user_account' => $userAccount,
            'entreprises' => $entrepriseRepository->findAll(), 
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_account_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserAccount $userAccount): Response
    {
        $form = $this->createForm(UserAccount1Type::class, $userAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_account_index');
        }

        return $this->render('user_account/edit.html.twig', [
            'user_account' => $userAccount,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_account_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserAccount $userAccount): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userAccount->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userAccount);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_account_index');
    }
}
