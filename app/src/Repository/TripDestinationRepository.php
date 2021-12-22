<?php
  
  
  namespace App\Repository;
  
  
  use App\Entity\TripDestination;
  use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
  
  interface TripDestinationRepository {
    
    public function all($filter,int $page, int $size, string $sort, string $direction):SlidingPagination;
  
    public function save(TripDestination $tripDestination): void;
  
    public function delete(TripDestination $tripDestination): void;
    
  }