<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startTime;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endTime;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfTests;

    /**
     * @ORM\Column(type="integer")
     */
    private $result;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Grid::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $grid;

    /**
     * @ORM\OneToMany(targetEntity=Grid::class, mappedBy="game", orphanRemoval=true)
     */
    private $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getNumberOfTests(): ?int
    {
        return $this->numberOfTests;
    }

    public function setNumberOfTests(int $numberOfTests): self
    {
        $this->numberOfTests = $numberOfTests;

        return $this;
    }

    public function getResult(): ?int
    {
        return $this->result;
    }

    public function setResult(int $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getGrid(): ?Grid
    {
        return $this->grid;
    }

    public function setGrid(?Grid $grid): self
    {
        $this->grid = $grid;

        return $this;
    }

    /**
     * @return Collection|Grid[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Grid $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
            $relation->setGame($this);
        }

        return $this;
    }

    public function removeRelation(Grid $relation): self
    {
        if ($this->relation->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getGame() === $this) {
                $relation->setGame(null);
            }
        }

        return $this;
    }
}
