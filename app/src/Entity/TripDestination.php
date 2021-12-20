<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TripDestination
 *
 * @ORM\Table(name="trip_destination", uniqueConstraints={@ORM\UniqueConstraint(name="name", columns={"name"})}, indexes={@ORM\Index(name="location_costs_id", columns={"location_costs"})})
 * @ORM\Entity
 */
class TripDestination
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \LocationCosts
     *
     * @ORM\ManyToOne(targetEntity="LocationCosts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location_costs", referencedColumnName="id")
     * })
     */
    private $locationCosts;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLocationCosts(): ?LocationCosts
    {
        return $this->locationCosts;
    }

    public function setLocationCosts(?LocationCosts $locationCosts): self
    {
        $this->locationCosts = $locationCosts;

        return $this;
    }


}
