<?php

namespace App\Controller;

use App\Entity\UsersGroup;
use App\Form\UsersGroupType;
use App\Repository\UsersGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/users/group")
 */
class UsersGroupController extends AbstractController
{
    /**
     * @Route("/", name="users_group_index", methods={"GET"})
     */
    public function index(UsersGroupRepository $usersGroupRepository): Response
    {
        return $this->render('users_group/index.html.twig', [
            'users_groups' => $usersGroupRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="users_group_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $usersGroup = new UsersGroup();
        $form = $this->createForm(UsersGroupType::class, $usersGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usersGroup);
            $entityManager->flush();

            return $this->redirectToRoute('users_group_index');
        }

        return $this->render('users_group/new.html.twig', [
            'users_group' => $usersGroup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="users_group_show", methods={"GET"})
     */
    public function show(UsersGroup $usersGroup): Response
    {
        return $this->render('users_group/show.html.twig', [
            'users_group' => $usersGroup,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="users_group_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UsersGroup $usersGroup): Response
    {
        $form = $this->createForm(UsersGroupType::class, $usersGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('users_group_index');
        }

        return $this->render('users_group/edit.html.twig', [
            'users_group' => $usersGroup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="users_group_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UsersGroup $usersGroup): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usersGroup->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($usersGroup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('users_group_index');
    }
}
