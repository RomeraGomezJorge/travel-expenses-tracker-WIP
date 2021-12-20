<?php
  
  namespace App\Controller;
  
  use App\Constants\FormConstant;
  use App\Constants\MessageConstants;
  use App\Constants\TwigFileNameConstants;
  use App\Entity\Employee;
  use App\Entity\LocationCosts;
  use App\Form\EmployeeType;
  use App\Form\LocationCostsType;
  use App\Repository\LocationCostsRepository;
  use Doctrine\ORM\EntityManagerInterface;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;
  
  /**
   * @Route("/backoffice/location-costs")
   */
  class LocationCostsController extends WebController {
    
    const TEMPLATES_FOLDER = 'backoffice/location_costs/';
    
    const INDEX_PATH = 'location_costs_index';
    
    const NEW_PATH = 'location_costs_new';
    
    const EDIT_PATH = 'location_costs_edit';
    
    const DELETE_PATH = 'location_costs_delete';
    
    private LocationCostsRepository $repository;
    
    public function __construct(LocationCostsRepository $repository) {
      $this->repository = $repository;
    }
    
    /**
     * @Route("/list", name="location_costs_index", methods={"GET", "POST"})
     */
    public function index(Request $request): Response {
      $pagination = $this->repository->all(
        $request->query->getInt('page', 1),
        $request->query->getInt('size', 10)
      );
      
      return $this->render(self::TEMPLATES_FOLDER . TwigFileNameConstants::INDEX,
        [
          'pagination' => $pagination,
          'page_title' => 'Location Costs',
          'index_path' => self::INDEX_PATH,
          'new_path' => self::NEW_PATH,
          'delete_path' => self::DELETE_PATH,
          'edit_path' => self::EDIT_PATH,
        ]);
    }
  
    /**
     * @Route("/new", name="location_costs_new", methods={"GET", "POST"})
     */
    public function new(Request $request): Response {
      
      $locationCosts = new LocationCosts();
      $form = $this->createForm(LocationCostsType::class, $locationCosts);
      $form->handleRequest($request);
    
      if ($form->isSubmitted() && $form->isValid()) {
        $this->repository->save($locationCosts);
      
        return $this->redirectWithSuccessMessage(
          self::INDEX_PATH,
          MessageConstants::SUCCESS_MESSAGE_TO_CREATE
        );
      }
    
      return $this->renderForm(self::TEMPLATES_FOLDER . TwigFileNameConstants::NEW,
        [
          'locationCosts' => $locationCosts,
          'form' => $form,
          'action_to_do' => FormConstant::CREATE_ACTION_TEXT,
          'page_title' => FormConstant::CREATE_ACTION_TEXT . ' Location Cost',
          'index_path' => self::INDEX_PATH,
        ]);
    }
  
    /**
     * @Route("/{locationCosts}/edit", name="location_costs_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, LocationCosts $locationCosts): Response {
      $form = $this->createForm(LocationCostsType::class, $locationCosts);
      $form->handleRequest($request);
    
      if ($form->isSubmitted() && $form->isValid()) {
        $this->repository->save($locationCosts);
      
        return $this->redirectWithSuccessMessage(
          self::INDEX_PATH,
          MessageConstants::SUCCESS_MESSAGE_TO_UPDATE
        );
      }
  
      return $this->renderForm(self::TEMPLATES_FOLDER . TwigFileNameConstants::EDIT,
        [
          'locationCosts' => $locationCosts,
          'form' => $form,
          'action_to_do' => FormConstant::UPDATE_ACTION_TEXT,
          'page_title' => FormConstant::UPDATE_ACTION_TEXT . ' Location Cost',
          'index_path' => self::INDEX_PATH,
        ]);
    }      
    
    /**
     * @Route("/{locationCosts}", name="location_costs_delete",
     *   methods={"POST"})
     */
    public function delete(Request $request, LocationCosts $locationCosts): Response {
      
      if (!$this->isCsrfTokenValid('delete',
        $request->request->get('_token'))) {
        return $this->redirectWithErrorMessage(
          self::INDEX_PATH,
          MessageConstants::INVALID_TOKEN_CSFR_MESSAGE
        );
      }
      
      $this->repository->delete($locationCosts);
      
      return $this->redirectWithSuccessMessage(
        self::INDEX_PATH,
        MessageConstants::SUCCESS_MESSAGE_TO_DELETE
      );
    }
    
  }
