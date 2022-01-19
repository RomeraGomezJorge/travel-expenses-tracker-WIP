<?php
  
  
  namespace App\Service\Resolution;
  
  
  use App\Controller\WebController;
  use App\Entity\Resolution;
  use App\Service\FileManager;
  use phpDocumentor\Reflection\Types\False_;
  use Symfony\Component\HttpFoundation\Request;
  
  
  final class ResolutionFileManager extends WebController {
  
  
    private FileManager $fileManager;
    
    public function __construct(FileManager $fileManager) {
      $this->fileManager = $fileManager;
    }
    
    public function uploadFiles(Resolution $resolution,Request $request): array {
      
      $fileNamePrefix = 'resolution-' . $resolution->getName() . '-' . $resolution->getYear();
      
      return $this->fileManager->uploadMultipleFilesAndGetFilesNames(
        $this->getParameter('resolution_directory'),
        $request->files->get('travel')['resolution']['file'],
        $fileNamePrefix
      );
    }
  
    public function removeFile(string $fileName) {
      $this->fileManager->removeFile($this->getParameter('resolution_directory'),$fileName);
    }
    
  }