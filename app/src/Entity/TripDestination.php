<?php
  
  namespace App\Entity;
  use Doctrine\Common\Collections\ArrayCollection;
  use Doctrine\Common\Collections\Collection;
  use Doctrine\ORM\Mapping as ORM;
  use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
  
  /**
   * TripDestination
   *
   * @ORM\Table(
   *   name="trip_destination",
   *   indexes={@ORM\Index(name="location_costs_id", columns={"location_costs"})}
   *   )
   * @UniqueEntity("name")
   * @ORM\Entity
   */
  class TripDestination {
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;
    
    /**
     * @var LocationCosts
     *
     * @ORM\ManyToOne(targetEntity="LocationCosts", cascade={"persist"},))
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location_costs", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * })
     */
    private $locationCosts;
  
    /**
     * @ORM\ManyToMany(targetEntity="Travel", mappedBy="tripDestinations")
     * @ORM\JoinTable(name="travel_destination",
     *                joinColumns={@ORM\JoinColumn(name="trip_destination_id", referencedColumnName="id", onDelete="CASCADE")},
     *                inverseJoinColumns={@ORM\JoinColumn(name="travel_id", referencedColumnName="id", onDelete="CASCADE")}
     *      )
     */
    private $travels;
  
    public function __construct() {
      $this->travels = new ArrayCollection();
    }
    
    public function getId(): ?int {
      return $this->id;
    }
    
    public function getName(): ?string {
      return $this->name;
    }
    
    public function setName(string $name): self {
      $this->name = $name;
      
      return $this;
    }
    
    public function getLocationCosts(): ?LocationCosts {
      return $this->locationCosts;
    }
    
    public function setLocationCosts(?LocationCosts $locationCosts): self {
      $this->locationCosts = $locationCosts;
      
      return $this;
    }
  
    /**
     * @return ArrayCollection|\App\Entity\Travel[]
     */
    public function getTravels(): Collection
    {
      return $this->travels;
    }
  
    public function addTravel(?Travel $travel): self
    {
      if (!$this->travels->contains($travel)) {
        $this->travels[] = $travel;
      }
      return $this;
    }
  
    public function removeTravel(?Travel $travel): self
    {
      if ($this->travels->contains($travel)) {
        $this->travels->removeElement($travel);
      }
    
      return $this;
    }
    
    public function __toString() {
      return $this->name;
    }
  
  }
