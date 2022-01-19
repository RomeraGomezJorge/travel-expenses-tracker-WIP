<?php
  
  
  namespace App\Repository;
  
  
  use App\Entity\Resolution;
  use App\Entity\Travel;
  use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
  use App\Repository\Doctrine\Travel\Filter\Filter;

  interface TravelRepository {
    
    public function all(Filter $filter,int $page, int $size, string $sort, string $direction):SlidingPagination;
    
    public function save(Travel $travel): void;
  
    public function delete(Travel $travel): void;
  
    public function removeOldReferenceToResolution(Resolution $resolution): void;
    
  }