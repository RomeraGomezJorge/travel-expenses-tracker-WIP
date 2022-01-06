<?php
  
  
  namespace App\Repository\Doctrine\Travel\Filter;

  use Symfony\Component\Validator\Constraints as Assert;
  
  final class Filter {
  
    /**
     * @var \DateTime
     * @Assert\LessThan(propertyPath="departureDateTill",
     *    message="This value should be less than Till Date.")
     */
    public  $departureDateFrom;
  
    /**
     * @var \DateTime
     * @Assert\GreaterThan(propertyPath="departureDateFrom",
     *    message="This value should be greater than From Date.")
     */
    public  $departureDateTill;
  
    /**
     * @var \DateTime
     * @Assert\LessThan(propertyPath="arrivalDateTill",
     *    message="This value should be less than Till Date.")
     */
    public  $arrivalDateFrom;
  
    /**
     * @var \DateTime
     * @Assert\GreaterThan(propertyPath="arrivalDateFrom",
     *    message="This value should be greater than From Date.")
     */
    public  $arrivalDateTill;
    public  $expenses;
    public  $resolution;
    public  $travellersNames;
    public  $tripDestination;
  }