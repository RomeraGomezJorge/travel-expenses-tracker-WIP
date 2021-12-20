<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity
 * @UniqueEntity(fields={"name", "surname"},
 *     message="This combination of NAME and SURNAME already exists.",
 *     errorPath="name"
 * )
 */
class Employee
{
  
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
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var int|null
     * @Assert\AtLeastOneOf({
     *     @Assert\Blank(),
     *     @Assert\Length(8)
     * })
     * @ORM\Column(name="identity_card", type="integer", nullable=true)
     */
    private $identityCard;
  
  /**
   * @ORM\ManyToMany(targetEntity="Travel", mappedBy="employees")
   */
    private $travels;
    
    public function __construct() {
      $this->travels = new ArrayCollection();
    }
  
  public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getIdentityCard(): ?int
    {
        return $this->identityCard;
    }

    public function setIdentityCard(?int $identityCard): self
    {
        $this->identityCard = $identityCard;

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
  
  public function __toString()
  {
    return $this->surname.', '.$this->name. ' - '.$this->identityCard;
  }

}
