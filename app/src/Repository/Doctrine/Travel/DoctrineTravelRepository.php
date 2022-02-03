<?php
  
  
  namespace App\Repository\Doctrine\Travel;
  
  use App\Entity\Resolution;
  use App\Entity\Travel;
  use App\Entity\TravellersName;
  use App\Repository\Doctrine\DoctrineRepository;
  use App\Repository\Doctrine\Travel\Filter\Filter;
  use App\Repository\TravelRepository;
  use Doctrine\ORM\Mapping\Entity;
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
        ->select('t', 'tripDestinations', 'travellersNames','resolution')
        ->select('t', 'tripDestinations')
        ->innerJoin('t.tripDestinations', 'tripDestinations')
        ->innerJoin('t.travellersNames', 'travellersNames')
        ->innerJoin('t.resolution', 'resolution');
      
      if ($filter->resolutionName) {
        $qb->andWhere($qb->expr()->like('LOWER(resolution.name)', ':resolutionName'));
        $qb->setParameter(':resolutionName', '%' . mb_strtolower($filter->resolutionName) . '%');
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
      
      if ($filter->travellersNames) {
        $qb->andWhere('travellersNames.employee = :travellersNames');
        $qb->orWhere('travellersNames.replacement = :travellersNames');
        $qb->setParameter(':travellersNames', $filter->travellersNames);
      }
      
      if ($filter->tripDestination) {
        $qb->andWhere('tripDestinations.id = :tripDestination');
        $qb->setParameter(':tripDestination', $filter->tripDestination);
      }
      
      if (!in_array($sort, [
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
    
    public function findById(int $id): Travel{
    	return $this->repository(self::ENTITY_CLASS)->findOneBy(['id'=>$id]);
    }
    
    public function save(Travel $employee): void {
      $this->persist($employee);
    }
    
    public function delete(Travel $employee): void {
      $this->remove($employee);
    }
  
    public function removeOldReferenceToResolution(Resolution $resolution): void {
  
      $resolution->setTravel(NULL);
      
      $this->remove($resolution);
      
    }
  
    public function removeOldReferenceToTravellersNames(TravellersName $travellersName): void {
	    $this->remove($travellersName);
    }
    
  }