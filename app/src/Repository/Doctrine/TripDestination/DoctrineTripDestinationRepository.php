<?php
  
  
  namespace App\Repository\Doctrine\TripDestination;
  
  use App\Entity\TripDestination;
  use App\Repository\Doctrine\DoctrineRepository;
  use App\Repository\TripDestinationRepository;
  use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
  use Knp\Component\Pager\PaginatorInterface;


  final class DoctrineTripDestinationRepository extends DoctrineRepository implements TripDestinationRepository {
    
    const ENTITY_CLASS = TripDestination::class;
    
    public function all( $filter,int $page, int $size, string $sort, string $direction):SlidingPagination {
      $qb = $this->repository(self::ENTITY_CLASS)
        ->createQueryBuilder('t')
        ->select('t.id','t.name','l.location','l.cost')
        ->innerJoin('t.locationCosts','l');
  
      if ($filter->name) {
        $qb->andWhere($qb->expr()->like('LOWER(t.name)', ':name'));
        $qb->setParameter(':name', '%' . mb_strtolower($filter->name) . '%');
      }
      
      if (!\in_array($sort, ['t.id','t.name', ], true)) {
        throw new \UnexpectedValueException('Cannot sort by ' . $sort);
      }
  
      $qb->orderBy($sort, $direction === 'desc' ? 'DESC' : 'ASC');
      
      return $this->paginator()->paginate($qb, $page, $size);
    }
    
    public function save(TripDestination $tripDestination): void {
      $this->persist($tripDestination);
    }
    
    public function delete(TripDestination $tripDestination): void {
      
      $this->remove($tripDestination);
    }
    
  }