<?php
  
  namespace App\Entity;


  use Doctrine\ORM\Mapping as ORM;
  use Symfony\Component\Validator\Constraints as Assert;
  
  
  /**
   * TravellersName
   *
   * @ORM\Table(name="travellers_name", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="employee_id", columns={"employee"}), @ORM\Index(name="replacement", columns={"replacement"}), @ORM\Index(name="replacement_id", columns={"id"}), @ORM\Index(name="travel_id", columns={"travel"})})
   * @ORM\Entity
   */
  class TravellersName {
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var \Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="employee", referencedColumnName="id")
     * })
     */
    private $employee;
    
    /**
     * @var \Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="replacement", referencedColumnName="id")
     * })
     */
    private $replacement;
    
    /**
     * @var \Travel
     *
     * @ORM\ManyToOne(targetEntity="Travel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="travel", referencedColumnName="id",
     *   nullable="true")
     * })
     */
    private $travel;
    
    public function getId(): ?int {
      return $this->id;
    }
    
    public function getEmployee(): ?Employee {
      return $this->employee;
    }
    
    public function setEmployee(?Employee $employee): self {
      $this->employee = $employee;
      
      return $this;
    }
    
    public function getReplacement(): ?Employee {
      return $this->replacement;
    }
    
    public function setReplacement(?Employee $replacement): self {
      $this->replacement = $replacement;
      
      return $this;
    }
    
    public function getTravel(): ?Travel {
      return $this->travel;
    }
    
    public function setTravel(?Travel $travel): self {
      $this->travel = $travel;
      
      return $this;
    }
    
    public function getReplacementFullname():string {
      return ($this->replacement === NULL)
        ? 'N/A'
        :$this->replacement->getFullname();
    }
    
  }
