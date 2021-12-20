<?php

namespace App\Controller;

use App\Entity\TripDestination;
use App\Form\TripDestinationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/trip/destination")
 */
class TripDestinationController extends AbstractController
{
    /**
     * @Route("/", name="trip_destination_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $tripDestinations = $entityManager
            ->getRepository(TripDestination::class)
            ->findAll();

        return $this->render('trip_destination/index.html.twig', [
            'trip_destinations' => $tripDestinations,
        ]);
    }

    /**
     * @Route("/new", name="trip_destination_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tripDestination = new TripDestination();
        $form = $this->createForm(TripDestinationType::class, $tripDestination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tripDestination);
            $entityManager->flush();

            return $this->redirectToRoute('trip_destination_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trip_destination/new.html.twig', [
            'trip_destination' => $tripDestination,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="trip_destination_show", methods={"GET"})
     */
    public function show(TripDestination $tripDestination): Response
    {
        return $this->render('trip_destination/show.html.twig', [
            'trip_destination' => $tripDestination,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="trip_destination_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TripDestination $tripDestination, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TripDestinationType::class, $tripDestination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('trip_destination_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trip_destination/edit.html.twig', [
            'trip_destination' => $tripDestination,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="trip_destination_delete", methods={"POST"})
     */
    public function delete(Request $request, TripDestination $tripDestination, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tripDestination->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tripDestination);
            $entityManager->flush();
        }

        return $this->redirectToRoute('trip_destination_index', [], Response::HTTP_SEE_OTHER);
    }
}
