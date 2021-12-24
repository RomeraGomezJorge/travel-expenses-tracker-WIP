<?php
  
  
  namespace App\Repository\Doctrine\Travel;
  
  use App\Entity\Travel;
  use App\Repository\Doctrine\DoctrineRepository;
  use App\Repository\Doctrine\Travel\Filter\Filter;
  use App\Repository\TravelRepository;
  use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
  
  final class DoctrineTravelRepository extends DoctrineRepository implements TravelRepository {
    
    const ENTITY_CLASS = Travel::class;
    
    public function all(
      Filter $filter,
      int $page,
      int $size,
      string $sort,
      string $direction
    ): SlidingPagination {
      $qb = $this->repository(self::ENTITY_CLASS)
        ->createQueryBuilder('t')
        ->select('t', 'tripDestinations', 'employees')
        ->innerJoin('t.tripDestinations', 'tripDestinations')
        ->innerJoin('t.employees', 'employees');
      
      if ($filter->resolution) {
        $qb->andWhere('t.resolution = :resolution');
        $qb->setParameter(':resolution', $filter->resolution);
      }
      
      if ($filter->departureDateFrom) {
        $qb->andWhere($qb->expr()->gt('t.departureDate', ':from'));
        $qb->setParameter(':from', $filter->departureDateFrom);
      }
      
      if ($filter->departureDateTill) {
        $qb->andWhere($qb->expr()->lt('t.departureDate', ':till'));
        $qb->setParameter(':till', $filter->departureDateTill);
      }
      
      if ($filter->arrivalDateFrom) {
        $qb->andWhere($qb->expr()->gt('t.arrivalDate', ':from'));
        $qb->setParameter(':from', $filter->arrivalDateFrom);
      }
      
      if ($filter->arrivalDateTill) {
        $qb->andWhere($qb->expr()->lt('t.arrivalDate', ':till'));
        $qb->setParameter(':till', $filter->arrivalDateTill);
      }
      
      if ($filter->expenses) {
        $qb->andWhere('t.expenses = :expenses');
        $qb->setParameter(':expenses', $filter->expenses);
      }
      
      if ($filter->employee) {
        $qb->andWhere('employees.id = :employee');
        $qb->setParameter(':employee', $filter->employee);
      }
      
      if ($filter->tripDestination) {
        $qb->andWhere('tripDestinations.id = :tripDestination');
        $qb->setParameter(':tripDestination', $filter->tripDestination);
      }
      
      if (!\in_array($sort, [
        't.id',
        't.resolution',
        't.departureDate',
        't.arrivalDate',
        't.expenses',
      ], TRUE)) {
        throw new \UnexpectedValueException('Cannot sort by ' . $sort);
      }
      
      $qb->orderBy($sort, $direction === 'desc' ? 'DESC' : 'ASC');
      
      return $this->paginator()->paginate($qb, $page, $size);
    }
    
    public function save(Travel $employee): void {
      $this->persist($employee);
    }
    
    public function delete(Travel $employee): void {
      $this->remove($employee);
    }
    
  }