<?php

namespace App\Controller;
use App\Entity\Annonce;

use App\Entity\User;
use App\Form\AnnonceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonce", name="annonce")
     */
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $repository = $doctrine->getRepository(Annonce::class);
        $annonces = $repository->findAll();

        return $this->render('annonce/index.html.twig', [
            'annonces' => $annonces,
            'user' => $this->getUser()
        ]);
    }

    /**
     * @Route("/annonce/new", name="new_annonce")
     */
    public function new_annonce(ManagerRegistry $doctrine, Request $request): Response
    {
        $manager = $doctrine->getManager();
        $annonce = new Annonce();

        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->add('add', SubmitType::class, ['label' => 'Create Annonce']);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $annonce = $form->getData();
            $annonce->setDateCreation(new \Datetime);

            //temp
            $user = new User();
            $user->setUsername("bob1");
            $user->setPassword("123456");
            $manager->persist($user);
            $manager->flush();
            //temp

            $annonce->setUser($user);

            $manager->persist($annonce);
            $manager->flush();
            return $this->redirectToRoute("annonce");
        }

        return $this->render('annonce/new.html.twig', [
            'title' => "Création d'une nouvelle annonce",
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/annonce/{id}/edit", name="edit_annonce")
     */
    public function edit_annonce(ManagerRegistry $doctrine, Request $request, Annonce $annonce): Response
    {
        $manager = $doctrine->getManager();

        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->add('edit', SubmitType::class, ['label' => 'Edit Annonce']);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $annonce = $form->getData();

            $manager->persist($annonce);
            $manager->flush();
            return $this->redirectToRoute("annonce");
        }

        return $this->render('annonce/new.html.twig', [
            'title' => "Modificiation de l'annonce ".$annonce->getId(),
            'annonce' => $annonce,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/annonce/{id}/delete", name="delete_annonce")
     */
    public function delete_annonce(ManagerRegistry $doctrine, Request $request, Annonce $annonce): Response
    {
        $manager = $doctrine->getManager();
        $manager->remove($annonce);
        $manager->flush();

        return $this->redirectToRoute("annonce");
    }


}
