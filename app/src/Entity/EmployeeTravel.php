<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmployeeTravel
 *
 * @ORM\Table(name="employee_travel", indexes={@ORM\Index(name="employee_id", columns={"employee_id"}), @ORM\Index(name="travel_id", columns={"travel_id"})})
 * @ORM\Entity
 */
class EmployeeTravel
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
     * @var \Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="employee_id", referencedColumnName="employee")
     * })
     */
    private $employee;

    /**
     * @var \Travel
     *
     * @ORM\ManyToOne(targetEntity="Travel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="travel_id", referencedColumnName="id")
     * })
     */
    private $travel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }

    public function getTravel(): ?Travel
    {
        return $this->travel;
    }

    public function setTravel(?Travel $travel): self
    {
        $this->travel = $travel;

        return $this;
    }


}
