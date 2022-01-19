<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Resolution
 *
 * @ORM\Table(name="resolution")
 * @ORM\Entity
 */
class Resolution
{
  
  const NOT_SET = NULL;
  
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer", nullable=true)
     */
    private $year;

    /**
     * @var array|null
     *
     * @ORM\Column(name="file", type="json", nullable=true)
     */
    private $file;
 

  /**
   * @ORM\OneToOne(targetEntity="Travel", inversedBy="resolution",cascade={"persist", "remove"})
   * @ORM\JoinColumn(name="travel_id", referencedColumnName="id")
   */
    private $travel;

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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getFile(): ?array
    {
        return $this->file;
    }

    public function addFile(?array $files): self
    {
        $this->file = ( $this->file === self::NOT_SET )
          ? $files
          : array_merge($files,$this->file);

        return $this;
    }
  
    public function removeFile(string $file) {
      $this->file = array_diff($this->file,[$file]);
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
