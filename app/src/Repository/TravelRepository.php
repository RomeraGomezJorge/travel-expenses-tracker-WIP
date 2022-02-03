<?php
	
	
	namespace App\Repository;
	
	
	use App\Entity\Resolution;
	use App\Entity\Travel;
	use App\Entity\TravellersName;
	use App\Repository\Doctrine\Travel\Filter\Filter;
	use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
	
	interface TravelRepository
	{
		public function all(Filter $filter, int $page, int $size, string $sort, string $direction): SlidingPagination;
		
		public function save(Travel $travel): void;
		
		public function delete(Travel $travel): void;
		
		public function findById(int $id): Travel;
		
		public function removeOldReferenceToResolution(Resolution $resolution): void;
		
		public function removeOldReferenceToTravellersNames(TravellersName $travel): void;
   
  }