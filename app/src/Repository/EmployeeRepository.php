<?php
  
  
  namespace App\Repository;
  
  
  use App\Entity\Employee;
  use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;

  interface EmployeeRepository {
    
    public function all($filter,int $page, int $size, string $sort, string $direction):SlidingPagination;
    
    public function save(Employee $employee): void;
  
    public function delete(Employee $employee): void;
    
  }