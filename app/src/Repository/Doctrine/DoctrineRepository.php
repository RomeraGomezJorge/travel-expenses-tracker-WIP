<?php
  
  
  namespace App\Repository\Doctrine;


  use Doctrine\ORM\EntityManager;
  use Doctrine\ORM\EntityManagerInterface;
  use Doctrine\ORM\EntityRepository;
  use Knp\Component\Pager\PaginatorInterface;

  abstract class DoctrineRepository
  {
    private EntityManagerInterface $entityManager;
  
    
    private PaginatorInterface $paginator;
  
    public function __construct(EntityManagerInterface $entityManager,  PaginatorInterface $paginator)
    {
      $this->entityManager = $entityManager;
      $this->paginator = $paginator;
    }
  
    protected function persist($entity): void
    {
      $this->entityManager()->persist($entity);
      $this->entityManager()->flush($entity);
    }
  
    protected function entityManager(): EntityManagerInterface
    {
      return $this->entityManager;
    }
  
    protected function paginator(): PaginatorInterface
    {
      return $this->paginator;
    }
  
  
    protected function remove($entity): void
    {
      $this->entityManager()->remove($entity);
      $this->entityManager()->flush($entity);
    }
  
    
    
    protected function repository($entityClass): EntityRepository
    {
      return $this->entityManager->getRepository($entityClass);
    }
  }