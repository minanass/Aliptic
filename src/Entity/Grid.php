<?php

namespace App\Entity;

use App\Repository\GridRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GridRepository::class)
 */
class Grid
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="array")
     */
    private $initialStructure = [];

    /**
     * @ORM\Column(type="array")
     */
    private $solution = [];

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

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getInitialStructure(): ?array
    {
        return $this->initialStructure;
    }

    public function setInitialStructure(array $initialStructure): self
    {
        $this->initialStructure = $initialStructure;

        return $this;
    }

    public function getSolution(): ?array
    {
        return $this->solution;
    }

    public function setSolution(array $solution): self
    {
        $this->solution = $solution;

        return $this;
    }
}
