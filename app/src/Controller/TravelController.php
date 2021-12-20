<?php

namespace App\Controller;

use App\Entity\Travel;
use App\Form\TravelType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/travel")
 */
class TravelController extends AbstractController
{
    /**
     * @Route("/", name="travel_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $travel = $entityManager
            ->getRepository(Travel::class)
            ->findAll();

        return $this->render('travel/index.html.twig', [
            'travel' => $travel,
        ]);
    }

    /**
     * @Route("/new", name="travel_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $travel = new Travel();
        $form = $this->createForm(TravelType::class, $travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($travel);
            $entityManager->flush();

            return $this->redirectToRoute('travel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('travel/new.html.twig', [
            'travel' => $travel,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="travel_show", methods={"GET"})
     */
    public function show(Travel $travel): Response
    {
        return $this->render('travel/show.html.twig', [
            'travel' => $travel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="travel_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Travel $travel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TravelType::class, $travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('travel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('travel/edit.html.twig', [
            'travel' => $travel,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="travel_delete", methods={"POST"})
     */
    public function delete(Request $request, Travel $travel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$travel->getId(), $request->request->get('_token'))) {
            $entityManager->remove($travel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('travel_index', [], Response::HTTP_SEE_OTHER);
    }
}