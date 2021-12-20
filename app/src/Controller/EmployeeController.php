<?php
  
  namespace App\Controller;
  
  
  use App\Constants\FormConstant;
  use App\Constants\MessageConstants;
  use App\Constants\TwigFileNameConstants;
  use App\Entity\Employee;
  use App\Form\EmployeeType;
  use App\Repository\Doctrine\Employee\Filter;
  use App\Repository\EmployeeRepository;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;
  /**
   * @Route("/backoffice/employee")
   */
  class EmployeeController extends WebController {
    
    const TEMPLATES_FOLDER = 'backoffice/employee/';
    
    const INDEX_PATH = 'employee_index';
    
    const NEW_PATH = 'employee_new';
    
    const EDIT_PATH = 'employee_edit';
    
    const DELETE_PATH = 'employee_delete';
    
    private EmployeeRepository $repository;
    
    public function __construct(EmployeeRepository $repository) {
      $this->repository = $repository;
    }
    
    /**
     * @Route("/list", name="employee_index", methods={"GET", "POST"})
     */
    public function index(Request $request): Response {
      $filter = new Filter\Filter();
      $form = $this->createForm(Filter\Form::class, $filter);
      $form->handleRequest($request);
      
      $pagination = $this->repository->all(
        $filter,
        $request->query->getInt('page', 1),
        $request->query->getInt('size', 10),
        $request->query->get('sort', 'e.id'),
        $request->query->get('direction', 'desc')
      );
      
      return $this->render(self::TEMPLATES_FOLDER . TwigFileNameConstants::INDEX,
        [
          'pagination' => $pagination,
          'page_title' => 'Employee',
          'index_path' => self::INDEX_PATH,
          'new_path' => self::NEW_PATH,
          'edit_path' => self::EDIT_PATH,
          'delete_path' => self::DELETE_PATH,
          'form_filter' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/new", name="employee_new", methods={"GET", "POST"})
     */
    public function new(Request $request): Response {
      $employee = new Employee();
      $form = $this->createForm(EmployeeType::class, $employee);
      $form->handleRequest($request);
      
      if ($form->isSubmitted() && $form->isValid()) {
        $this->repository->save($employee);
        
        return $this->redirectWithSuccessMessage(
          self::INDEX_PATH,
          MessageConstants::SUCCESS_MESSAGE_TO_CREATE
        );
      }
      
      return $this->renderForm(self::TEMPLATES_FOLDER . TwigFileNameConstants::NEW,
        [
          'employee' => $employee,
          'form' => $form,
          'action_to_do' => FormConstant::CREATE_ACTION_TEXT,
          'page_title' => FormConstant::CREATE_ACTION_TEXT . ' Employee',
          'index_path' => self::INDEX_PATH,
        ]);
    }
    
    /**
     * @Route("/{employee}/edit", name="employee_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Employee $employee): Response {
      $form = $this->createForm(EmployeeType::class, $employee);
      $form->handleRequest($request);
      
      if ($form->isSubmitted() && $form->isValid()) {
        $this->repository->save($employee);
        
        return $this->redirectWithSuccessMessage(
          self::INDEX_PATH,
          MessageConstants::SUCCESS_MESSAGE_TO_UPDATE
        );
      }
      
      return $this->renderForm(self::TEMPLATES_FOLDER . TwigFileNameConstants::EDIT,
        [
          'employee' => $employee,
          'form' => $form,
          'action_to_do' => FormConstant::UPDATE_ACTION_TEXT,
          'page_title' => FormConstant::UPDATE_ACTION_TEXT . ' Employee',
          'index_path' => self::INDEX_PATH,
        ]);
    }
    
    /**
     * @Route("/list/{employee}", name="employee_delete", methods={"POST"})
     */
    public function delete(Request $request, Employee $employee): Response {
      if (!$this->isCsrfTokenValid('delete',
        $request->request->get('_token'))) {
        return $this->redirectWithErrorMessage(
          self::INDEX_PATH,
          MessageConstants::INVALID_TOKEN_CSFR_MESSAGE
        );
      }
      
      $this->repository->delete($employee);
      
      return $this->redirectWithSuccessMessage(
        self::INDEX_PATH,
        MessageConstants::SUCCESS_MESSAGE_TO_DELETE
      );
    }
    
  }
