<?php
  
  
  namespace App\Repository;
  
  
  use App\Entity\LocationCosts;

  interface LocationCostsRepository {
    
    public function all(int $page, int $size);
    
    public function findById(int $id);
  
    public function save(LocationCosts $locationCosts): void;
  
    public function delete(LocationCosts $locationCosts): void;
    
  }