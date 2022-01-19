<?php
  
  
  namespace App\Service;
  
  
  use Psr\Log\NullLogger;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\Filesystem\Exception\IOException;
  use Symfony\Component\Filesystem\Filesystem;
  use Symfony\Component\HttpFoundation\File\Exception\FileException;
  use Symfony\Component\HttpFoundation\File\UploadedFile;
  use Symfony\Component\String\Slugger\SluggerInterface;
  
  final class FileManager{
    
    private SluggerInterface $slugger;
    private Filesystem $filesystem;
    
    public function __construct(SluggerInterface $slugger,Filesystem $filesystem) {
      $this->slugger = $slugger;
      $this->filesystem = $filesystem;
    }
    
    public function uploadASingleFileAndGetFileName(
      string $filesDir,
      ?UploadedFile $uploadedFile,
      ?string $fileName = NULL
    ): ?string {
      
      if ($uploadedFile === NULL){
        return $uploadedFile;
      }
      
      $originalFilename = ($fileName !== NULL )
        ? $fileName
        : pathinfo($uploadedFile->getClientOriginalName(),PATHINFO_FILENAME);
      
      // this is needed to safely include the file name as part of the URL
      $safeFilename = $this->slugger->slug($originalFilename);
      $newFilename = $safeFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();
      
      try {
        $uploadedFile->move($filesDir, $newFilename);
      } catch (FileException $exception) {
        echo $exception->getMessage();
      }
      
      return $newFilename;
    }
    
    public function uploadMultipleFilesAndGetFilesNames(
      string $filesDir,
      ?array $files,
      ?string $fileName = NULL
    ):array {
      
      if (empty($files)) {
        return $files;
      }
  
      $filesNames = [];
      
      foreach ($files as $file) {
        $filesNames[] = $this->uploadASingleFileAndGetFileName(
          $filesDir,
          $file,
          $fileName
        );
      }
      
      return $filesNames;
    }
    
    public function removeFile(string $filesDir, ?string $filename) {
      if (!$filename) {
        return;
      }
      
      $fullPathToFile =  $filesDir . '/' . $filename;
      
      try {
        if($this->filesystem->exists($fullPathToFile)) {
          $this->filesystem->remove($fullPathToFile);
        }
      } catch (IOException $exception) {
        echo $exception->getMessage();
      }
    }
    
  }