<?php
  
  
  namespace App\Repository;
  
  
  use App\Entity\LocationCosts;
  use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
  
  interface LocationCostsRepository {
    
    public function all(int $page, int $size):SlidingPagination;
  
    public function save(LocationCosts $locationCosts): void;
  
    public function delete(LocationCosts $locationCosts): void;
    
  }