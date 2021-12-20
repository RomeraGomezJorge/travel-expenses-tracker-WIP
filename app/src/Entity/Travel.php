<?php
  
  namespace App\Entity;
  
  use Doctrine\Common\Collections\ArrayCollection;
  use Doctrine\Common\Collections\Collection;
  use Doctrine\ORM\Mapping as ORM;
  
  /**
   * Travel
   *
   * @ORM\Table(name="travel", indexes={@ORM\Index(name="trip_destination_id", columns={"trip_destination_id"})})
   * @ORM\Entity
   */
  class Travel {
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departure_date", type="date", nullable=false)
     */
    private $departureDate;
    
    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="arrival_date", type="date", nullable=true)
     */
    private $arrivalDate;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="travel_expenses", type="decimal", precision=10,
     *   scale=0, nullable=true)
     */
    private $travelExpenses;
    
    /**
     * @var int|null
     *
     * @ORM\Column(name="resolution_number", type="integer", nullable=true)
     */
    private $resolutionNumber;
    
    /**
     * @var \TripDestination
     *
     * @ORM\ManyToOne(targetEntity="TripDestination")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trip_destination_id", referencedColumnName="id")
     * })
     */
    private $tripDestination;
    
    /**
     * @ORM\ManyToMany(targetEntity="Employee", inversedBy="travels", cascade={"persist"})
     * @ORM\JoinTable(name="employee_travel",
     *      joinColumns={@ORM\JoinColumn(name="travel_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="employee_id", referencedColumnName="id", onDelete="CASCADE")}
     *      )
     */
    private $employees;
    
    public function __construct() {
      $this->employees = new ArrayCollection();
    }
    
    public function getId(): ?int {
      return $this->id;
    }
    
    public function getDepartureDate(): ?\DateTimeInterface {
      return $this->departureDate;
    }
    
    public function setDepartureDate(\DateTimeInterface $departureDate): self {
      $this->departureDate = $departureDate;
      
      return $this;
    }
    
    public function getArrivalDate(): ?\DateTimeInterface {
      return $this->arrivalDate;
    }
    
    public function setArrivalDate(?\DateTimeInterface $arrivalDate): self {
      $this->arrivalDate = $arrivalDate;
      
      return $this;
    }
    
    public function getTravelExpenses(): ?string {
      return $this->travelExpenses;
    }
    
    public function setTravelExpenses(?string $travelExpenses): self {
      $this->travelExpenses = $travelExpenses;
      
      return $this;
    }
    
    public function getResolutionNumber(): ?int {
      return $this->resolutionNumber;
    }
    
    public function setResolutionNumber(?int $resolutionNumber): self {
      $this->resolutionNumber = $resolutionNumber;
      
      return $this;
    }
    
    public function getTripDestination(): ?TripDestination {
      return $this->tripDestination;
    }
    
    public function setTripDestination(?TripDestination $tripDestination
    ): self {
      $this->tripDestination = $tripDestination;
      
      return $this;
    }
    
    /**
     * @return ArrayCollection|employee[]
     */
    public function getEmployees(): Collection {
      return $this->employees;
    }
    
    public function addEmployee(employee $employee) {
      if (!$this->employees->contains($employee)) {
        $this->employees[] = $employee;
      }
      return $this;
    }
    
    public function removeEmployee(employee $employee): self {
      if ($this->employees->contains($employee)) {
        $this->employees->removeElement($employee);
      }
      
      return $this;
    }
    
  }
