<?php
  
  
  namespace App\Repository\Doctrine;
  
  
  
  use App\Entity\LocationCosts;
  use App\Repository\LocationCostsRepository;
  use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
  

  final class DoctrineLocationCostsRepository extends DoctrineRepository implements LocationCostsRepository {
    
    const ENTITY_CLASS = LocationCosts::class;
    
    public function all($page, $size):SlidingPagination {

      $qb = $this->repository(self::ENTITY_CLASS)
        ->createQueryBuilder('l')
        ->select('l.id','l.location','l.cost');
      
      return $this->paginator()->paginate($qb, $page, $size);
    }
    
    public function save(LocationCosts $locationCosts): void {
      $this->persist($locationCosts);
    }
    
    public function delete(LocationCosts $locationCosts): void {
      
      $this->remove($locationCosts);
    }
    
  }