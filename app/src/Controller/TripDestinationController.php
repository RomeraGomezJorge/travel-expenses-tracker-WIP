<?php
  
  namespace App\Controller;
  
  use App\Constants\FormConstant;
  use App\Constants\MessageConstants;
  use App\Constants\TwigFileNameConstants;
  use App\Entity\Employee;
  use App\Entity\TripDestination;
  use App\Form\TripDestinationType;
  use App\Repository\TripDestinationRepository;
  use Doctrine\ORM\EntityManagerInterface;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use App\Repository\Doctrine\TripDestination\Filter;
  use Symfony\Component\Routing\Annotation\Route;
  
  /**
   * @Route("/backoffice/trip-destination")
   */
  class TripDestinationController extends WebController {
    
    const TEMPLATES_FOLDER = 'backoffice/trip_destination/';
    
    const INDEX_PATH = 'trip_destination_index';
    
    const NEW_PATH = 'trip_destination_new';
    
    const EDIT_PATH = 'trip_destination_edit';
    
    const DELETE_PATH = 'trip_destination_delete';
  
    
    private TripDestinationRepository $repository;
  
    public function __construct(TripDestinationRepository $repository) {
      $this->repository = $repository;
    }
  
    /**
     * @Route("/list", name="trip_destination_index", methods={"GET", "POST"})
     */
    public function index(Request $request): Response {
      $filter = new Filter\Filter();
      $form = $this->createForm(Filter\Form::class, $filter);
      $form->handleRequest($request);
    
      $pagination = $this->repository->all(
        $filter,
        $request->query->getInt('page', 1),
        $request->query->getInt('size', 10),
        $request->query->get('sort', 't.id'),
        $request->query->get('direction', 'desc')
      );
    
      return $this->render(self::TEMPLATES_FOLDER . TwigFileNameConstants::INDEX,
        [
          'pagination' => $pagination,
          'page_title' => 'Trip Destination',
          'index_path' => self::INDEX_PATH,
          'new_path' => self::NEW_PATH,
          'edit_path' => self::EDIT_PATH,
          'delete_path' => self::DELETE_PATH,
          'form_filter' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/new", name="trip_destination_new", methods={"GET", "POST"})
     */
    public function new(Request $request): Response {
      $tripDestination = new TripDestination();
      $form = $this->createForm(TripDestinationType::class, $tripDestination);
      $form->handleRequest($request);
      
      if ($form->isSubmitted() && $form->isValid()) {
        $this->repository->save($tripDestination);
        return $this->redirectWithSuccessMessage(
          self::INDEX_PATH,
          MessageConstants::SUCCESS_MESSAGE_TO_CREATE
        );
      }
  
      return $this->renderForm(self::TEMPLATES_FOLDER . TwigFileNameConstants::NEW,
        [
          'tripDestination' => $tripDestination,
          'form' => $form,
          'action_to_do' => FormConstant::CREATE_ACTION_TEXT,
          'page_title' => FormConstant::CREATE_ACTION_TEXT . ' Trip Destination',
          'index_path' => self::INDEX_PATH,
        ]);
    }
    
    
    /**
     * @Route("/{tripDestination}/edit", name="trip_destination_edit", methods={"GET",
     *   "POST"})
     */
    public function edit(Request $request,TripDestination $tripDestination): Response {
      $form = $this->createForm(TripDestinationType::class, $tripDestination);
      $form->handleRequest($request);
      
      if ($form->isSubmitted() && $form->isValid()) {
        $this->repository->save($tripDestination);
  
        return $this->redirectWithSuccessMessage(
          self::INDEX_PATH,
          MessageConstants::SUCCESS_MESSAGE_TO_UPDATE
        );
      }
  
      return $this->renderForm(self::TEMPLATES_FOLDER . TwigFileNameConstants::EDIT,
        [
          'tripDestination' => $tripDestination,
          'form' => $form,
          'action_to_do' => FormConstant::UPDATE_ACTION_TEXT,
          'page_title' => FormConstant::UPDATE_ACTION_TEXT . ' Employee',
          'index_path' => self::INDEX_PATH,
        ]);
    }
    
   
    /**
     * @Route("/list/{tripDestination}", name="trip_destination_delete", methods={"POST"})
     */
    public function delete(Request $request, TripDestination $tripDestination): Response {
      if (!$this->isCsrfTokenValid('delete',
        $request->request->get('_token'))) {
        return $this->redirectWithErrorMessage(
          self::INDEX_PATH,
          MessageConstants::INVALID_TOKEN_CSFR_MESSAGE
        );
      }
    
      $this->repository->delete($tripDestination);
    
      return $this->redirectWithSuccessMessage(
        self::INDEX_PATH,
        MessageConstants::SUCCESS_MESSAGE_TO_DELETE
      );
    }
    
  }
