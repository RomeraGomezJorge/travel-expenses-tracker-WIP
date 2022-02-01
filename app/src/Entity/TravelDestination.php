<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TravelDestination
 *
 * @ORM\Table(name="travel_destination")
 * @ORM\Entity
 */
class TravelDestination
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
     * @var int
     *
     * @ORM\Column(name="trip_destination_id", type="integer", nullable=false)
     */
    private $tripDestinationId;

    /**
     * @var int
     *
     * @ORM\Column(name="travel_id", type="integer", nullable=false)
     */
    private $travelId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTripDestinationId(): ?int
    {
        return $this->tripDestinationId;
    }

    public function setTripDestinationId(int $tripDestinationId): self
    {
        $this->tripDestinationId = $tripDestinationId;

        return $this;
    }

    public function getTravelId(): ?int
    {
        return $this->travelId;
    }

    public function setTravelId(int $travelId): self
    {
        $this->travelId = $travelId;

        return $this;
    }


}
