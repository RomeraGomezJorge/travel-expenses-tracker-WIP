<?php
	
	namespace App\Controller;
  
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\HttpFoundation\RedirectResponse;
  
  
  abstract class WebController extends AbstractController
  {
    public function redirectWithSuccessMessage(string $routeName, string $message): RedirectResponse{
      $this->addFlash('success', $message);
      return $this->redirectToRoute($routeName);
    }
    
    public function redirectWithErrorMessage(string $routeName, string $message, array $parameters = []): RedirectResponse {
      $this->addFlash('hasErrors', true);
      $this->addFlash('error', $message);
      return $this->redirectToRoute($routeName,$parameters);
    }

  }
	