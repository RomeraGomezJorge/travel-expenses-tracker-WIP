<?php
  
  
  namespace App\Repository\Doctrine;
  
  use App\Entity\Employee;
  use App\Repository\EmployeeRepository;
  use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;

  final class DoctrineEmployeeRepository extends DoctrineRepository implements EmployeeRepository {
    
    const ENTITY_CLASS = Employee::class;
    
    public function all( $filter,int $page, int $size, string $sort, string $direction):SlidingPagination {
      $qb = $this->repository(self::ENTITY_CLASS)
        ->createQueryBuilder('e')
        ->select('e.id','e.name','e.surname','e.identityCard');
  
      if ($filter->name) {
        $qb->andWhere($qb->expr()->like('LOWER(e.name)', ':name'));
        $qb->setParameter(':name', '%' . mb_strtolower($filter->name) . '%');
      }
  
      if ($filter->surname) {
        $qb->andWhere($qb->expr()->like('LOWER(e.surname)', ':surname'));
        $qb->setParameter(':surname', '%' . mb_strtolower($filter->surname) . '%');
      }
  
      if ($filter->identityCard) {
        $qb->andWhere('e.identityCard = :identityCard');
        $qb->setParameter(':identityCard', $filter->identityCard);
      }
      
      
      if (!\in_array($sort, ['e.id','e.surname', 'e.name', 'e.identityCard'], true)) {
        throw new \UnexpectedValueException('Cannot sort by ' . $sort);
      }
  
      $qb->orderBy($sort, $direction === 'desc' ? 'DESC' : 'ASC');
      
      return $this->paginator()->paginate($qb, $page, $size);
    }
    
    public function save(Employee $employee): void {
      $this->persist($employee);
    }
    
    public function delete(Employee $employee): void {
      
      $this->remove($employee);
    }
    
  }