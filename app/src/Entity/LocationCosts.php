<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * LocationCosts
 *
 * @ORM\Table(name="location_costs", uniqueConstraints={@ORM\UniqueConstraint(name="location", columns={"location"})})
 * @UniqueEntity("location")
 * @ORM\Entity
 */
class LocationCosts
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
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=false)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="cost", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $cost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(string $cost): self
    {
        $this->cost = $cost;

        return $this;
    }
  
    public function locationAndCost():?string {
      return $this->location .' ( $'.$this->cost .')';
    }

}
