<?php

namespace App\Controller;

use App\Entity\LocationCosts;
use App\Form\LocationCostsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/location/costs")
 */
class LocationCostsController extends AbstractController
{
    /**
     * @Route("/", name="location_costs_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $locationCosts = $entityManager
            ->getRepository(LocationCosts::class)
            ->findAll();

        return $this->render('location_costs/index.html.twig', [
            'location_costs' => $locationCosts,
        ]);
    }

    /**
     * @Route("/new", name="location_costs_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $locationCost = new LocationCosts();
        $form = $this->createForm(LocationCostsType::class, $locationCost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($locationCost);
            $entityManager->flush();

            return $this->redirectToRoute('location_costs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location_costs/new.html.twig', [
            'location_cost' => $locationCost,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="location_costs_show", methods={"GET"})
     */
    public function show(LocationCosts $locationCost): Response
    {
        return $this->render('location_costs/show.html.twig', [
            'location_cost' => $locationCost,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="location_costs_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, LocationCosts $locationCost, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LocationCostsType::class, $locationCost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('location_costs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location_costs/edit.html.twig', [
            'location_cost' => $locationCost,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="location_costs_delete", methods={"POST"})
     */
    public function delete(Request $request, LocationCosts $locationCost, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$locationCost->getId(), $request->request->get('_token'))) {
            $entityManager->remove($locationCost);
            $entityManager->flush();
        }

        return $this->redirectToRoute('location_costs_index', [], Response::HTTP_SEE_OTHER);
    }
}
