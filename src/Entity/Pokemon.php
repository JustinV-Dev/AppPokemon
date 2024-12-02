<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $pokedex = null;

    /**
     * @var Collection<int, Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'pokemon')]
    private Collection $category;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'evolution')]
    private ?self $devolution = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'devolution')]
    private Collection $evolution;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->evolution = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPokedex(): ?int
    {
        return $this->pokedex;
    }

    public function setPokedex(int $pokedex): static
    {
        $this->pokedex = $pokedex;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->category->removeElement($category);

        return $this;
    }

    public function getDevolution(): ?self
    {
        return $this->devolution;
    }

    public function setDevolution(?self $devolution): static
    {
        $this->devolution = $devolution;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getEvolution(): Collection
    {
        return $this->evolution;
    }

    public function addEvolution(self $evolution): static
    {
        if (!$this->evolution->contains($evolution)) {
            $this->evolution->add($evolution);
            $evolution->setDevolution($this);
        }

        return $this;
    }

    public function removeEvolution(self $evolution): static
    {
        if ($this->evolution->removeElement($evolution)) {
            // set the owning side to null (unless already changed)
            if ($evolution->getDevolution() === $this) {
                $evolution->setDevolution(null);
            }
        }

        return $this;
    }
}
