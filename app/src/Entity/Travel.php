<?php
  
  namespace App\Entity;
  
  use Doctrine\Common\Collections\ArrayCollection;
  use Doctrine\Common\Collections\Collection;
  use Doctrine\ORM\Mapping as ORM;
  use Symfony\Component\Validator\Constraints as Assert;
  
  /**
   * Travel
   *
   * @ORM\Table(name="travel")
   * @ORM\Entity
   */
  class Travel {
    
    public function __construct() {
      $this->travellersNames = new ArrayCollection();
      $this->tripDestinations = new ArrayCollection();
    }
    
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
     * @Assert\LessThanOrEqual(propertyPath="arrivalDate")
     * @Assert\NotBlank()
     */
    private $departureDate;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrival_date", type="date", nullable=false)
     * @Assert\LessThanOrEqual("today UTC")
     * @Assert\GreaterThanOrEqual(propertyPath="departureDate")
     * @Assert\NotBlank()
     */
    private $arrivalDate;
    
    /**
     * @var string
     *
     * @ORM\Column(name="travel_expenses", type="decimal", precision=10,
     *   scale=0, nullable=false)
     * @Assert\NotBlank()
     */
    private $expenses;
    
    /**
     * @ORM\OneToOne(targetEntity="Resolution", mappedBy="travel",
     *   cascade={"persist", "remove"})
     */
    private $resolution;
    
    /**
     * @ORM\OneToMany(targetEntity="TravellersName", mappedBy="travel", cascade={"persist","remove"})
     */
    private $travellersNames;
    
    /**
     * @ORM\ManyToMany(targetEntity="TripDestination", inversedBy="travels", cascade={"persist"})
     * @ORM\JoinTable(name="travel_destination",
     *                joinColumns={@ORM\JoinColumn(name="travel_id", referencedColumnName="id", onDelete="CASCADE")},
     *                inverseJoinColumns={@ORM\JoinColumn(name="trip_destination_id", referencedColumnName="id", onDelete="CASCADE")}
     *      )
     * @Assert\NotBlank()
     */
    private $tripDestinations;
    
    public function getId(): ?int {
      return $this->id;
    }
    
    public function getDepartureDate(): ?\DateTimeInterface {
      return $this->departureDate;
    }
    
    public function setDepartureDate(?\DateTimeInterface $departureDate): self {
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
    
    public function getExpenses(): ?string {
      return $this->expenses;
    }
    
    public function setExpenses(?string $expenses): self {
      $this->expenses = $expenses;
      
      return $this;
    }
    
    /**
     * @return ArrayCollection|TravellersName[]
     */
    public function getTravellersNames(): Collection {
      return $this->travellersNames;
    }
    
    public function addTravellersName(TravellersName $travellersName) {
	    if (!$this->travellersNames->contains($travellersName)) {
		    $travellersName->setTravel($this);
		    $this->travellersNames->add($travellersName);
	    }
    }
    
    public function removeTravellersName(TravellersName $travellersName): self {
      if ($this->travellersNames->contains($travellersName)) {
	      $this->travellersNames->removeElement($travellersName);
      }
      
      return $this;
    }
    
    /**
     * @return ArrayCollection|tripDestinations[]
     */
    public function getTripDestinations(): Collection {
      return $this->tripDestinations;
    }
    
    public function addTripDestination(TripDestination $tripDestination) {
      if (!$this->tripDestinations->contains($tripDestination)) {
        $this->tripDestinations[] = $tripDestination;
      }
      return $this;
    }
    
    public function removeTripDestination(TripDestination $tripDestination
    ): self {
      if ($this->tripDestinations->contains($tripDestination)) {
        $this->tripDestinations->removeElement($tripDestination);
      }
      
      return $this;
    }
    
    public function getResolution() {
      return $this->resolution;
    }
    
    public function setResolution(?Resolution $resolution): self {
      // unset the owning side of the relation if necessary
      if ($resolution === NULL && $this->resolution !== NULL) {
        $this->resolution->setTravel(NULL);
      }
      
      // set the owning side of the relation if necessary
      if ($resolution !== NULL && $resolution->getTravel() !== $this) {
        $resolution->setTravel($this);
      }
      
      $this->resolution = $resolution;
  
      if ($this->departureDate !== NULL) {
        $this->resolution->setYear($this->departureDate->format('Y'));
      }
      
      
      return $this;
    }
  
    public function updateResolution() {
      
    }
    
  }

