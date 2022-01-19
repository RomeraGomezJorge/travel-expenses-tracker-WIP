<?php
  
  namespace App\Controller;
  
  use App\ConstantVariables\FormConstants;
  use App\ConstantVariables\MessageConstants;
  use App\ConstantVariables\TwigFileNameConstants;
  use App\Entity\Travel;
  use App\Form\Travel\TravelType;
  use App\Repository\Doctrine\Travel\Filter;
  use App\Repository\TravelRepository;
  use App\Service\FileManager;
  use App\Service\Resolution\ResolutionFileManager;
  use Symfony\Component\HttpFoundation\JsonResponse;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\String\Slugger\SluggerInterface;
  use Symfony\Component\Routing\Annotation\Route;
  use Exception;

  /**
   * @Route("/travel")
   */
  class TravelController extends WebController {
    
    const TEMPLATES_FOLDER = 'backoffice/travel/';
    
    const INDEX_PATH = 'travel_index';
    
    const NEW_PATH = 'travel_new';
    
    const EDIT_PATH = 'travel_edit';
    
    const DELETE_PATH = 'travel_delete';
    
    const DELETE_FILE_PATH = 'travel_delete_resolution_file';
    
    private TravelRepository $repository;
    
    private SluggerInterface $slugger;
    
    private  ResolutionFileManager $fileManager;
 
  
    public function __construct(
      TravelRepository $repository,
      SluggerInterface $slugger,
      ResolutionFileManager $fileManager
    ) {
      $this->repository = $repository;
      $this->slugger = $slugger;
      $this->fileManager = $fileManager;
    }
    
    /**
     * @Route("/list", name="travel_index", methods={"GET", "POST"})
     */
    public function index(Request $request): Response {
      $filter = new Filter\Filter();
      $form = $this->createForm(Filter\Form::class, $filter);
      $form->handleRequest($request);
      if($form->isSubmitted() && !$form->isValid()){
        return $this->redirectWithErrorMessage(
          self::INDEX_PATH,
          MessageConstants::UNEXPECTED_ERROR_HAS_OCCURRED
        );
      }
      
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
          'page_title' => 'Travel',
          'index_path' => self::INDEX_PATH,
          'new_path' => self::NEW_PATH,
          'edit_path' => self::EDIT_PATH,
          'delete_path' => self::DELETE_PATH,
          'form_filter' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/new", name="travel_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FileManager $fileUploader): Response {
      $travel = new Travel();
      $form = $this->createForm(TravelType::class, $travel);
      $form->handleRequest($request);
      
      if ($form->isSubmitted() && $form->isValid()) {
  
        $fileNames = $this->fileManager->uploadFiles(
          $travel->getResolution(),
          $request);
        
        $travel->getResolution()->addFile($fileNames);
          
        $this->repository->save($travel);
          
         return $this->redirectWithSuccessMessage(
            self::INDEX_PATH,
            MessageConstants::SUCCESS_MESSAGE_TO_CREATE
          );
        }
        
        return $this->renderForm(self::TEMPLATES_FOLDER . TwigFileNameConstants::NEW,
          [
            'travel' => $travel,
            'form' => $form,
            'action_to_do' => FormConstants::CREATE_ACTION_TEXT,
            'page_title' => FormConstants::CREATE_ACTION_TEXT . ' Travel',
            'index_path' => self::INDEX_PATH,
          ]);
      }
      
      /**
       * @Route("/{travel}/edit", name="travel_edit", methods={"GET", "POST"})
       */
      public function edit(Request $request, Travel $travel): Response {
        $form = $this->createForm(TravelType::class, $travel);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid() ) {

          $resolution = $travel->getResolution();
          
          $fileNames = $this->fileManager->uploadFiles(
            $travel->getResolution(),
            $request);
  
          $resolution->addFile($fileNames);
          
          $this->repository->removeOldReferenceToResolution($resolution);
          
          $travel->setResolution($resolution);
          
          $this->repository->save($travel);
          
          return $this->redirectWithSuccessMessage(
            self::INDEX_PATH,
            MessageConstants::SUCCESS_MESSAGE_TO_UPDATE
          );
        }
        
        return $this->renderForm(self::TEMPLATES_FOLDER . TwigFileNameConstants::EDIT,
          [
            'travel' => $travel,
            'form' => $form,
            'action_to_do' => FormConstants::UPDATE_ACTION_TEXT,
            'page_title' => FormConstants::UPDATE_ACTION_TEXT . ' Travel',
            'index_path' => self::INDEX_PATH,
            'delete_file_path' => self::DELETE_FILE_PATH
          ]);
      }
      
      /**
       * @Route("/list/{travel}", name="travel_delete", methods={"POST"})
       */
      public function delete(Request $request, Travel $travel): Response {
        if (!$this->isCsrfTokenValid('delete',
          $request->request->get('_token'))) {
          return $this->redirectWithErrorMessage(
            self::INDEX_PATH,
            MessageConstants::INVALID_TOKEN_CSFR_MESSAGE
          );
        }
        
        $this->repository->delete($travel);
        
        return $this->redirectWithSuccessMessage(
          self::INDEX_PATH,
          MessageConstants::SUCCESS_MESSAGE_TO_DELETE
        );
      }
  
    /**
     * @Route("/{travel}/{file}/delete-resolution-file", name="travel_delete_resolution_file", methods={"POST"})
     */
    public function deleteResolutionFile(Request $request, Travel $travel, $file): JsonResponse {
      
        if (!$this->isCsrfTokenValid('delete',
          $request->request->get('_token'))) {
          return $this->json([
              'fail_invalid_csfr_token' =>MessageConstants::INVALID_TOKEN_CSFR_MESSAGE]
          );
        }
      
        $resolution = $travel->getResolution();
      
        $this->repository->removeOldReferenceToResolution($resolution);
  
        $resolution->removeFile($file);
        
        $this->fileManager->removeFile($file);
      
        $travel->setResolution($resolution);
      
        $this->repository->save($travel);
  
        return $this->json(['success']);
    }
  
  
  }
