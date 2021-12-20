<?php
  
  
  namespace App\Repository;
  
  
  use App\Entity\Employee;

  interface EmployeeRepository {
    
    public function all($filter,int $page, int $size, string $sort, string $direction);
    
    public function findById(int $id);
  
    public function save(Employee $employee): void;
  
    public function delete(Employee $employee): void;
    
  }