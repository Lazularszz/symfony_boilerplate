<?php

namespace App\Entity;

use App\Repository\FromageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FromageRepository::class)]
class Fromage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Burger::class, mappedBy: 'fromages')]
    private Collection $burgers;

    public function __construct()
    {
        $this->burgers = new ArrayCollection();
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

    /**
     * @return Collection<int, Burger>
     */
    public function getBurgers(): Collection
    {
        return $this->burgers;
    }

    public function addBurger(Burger $burger): static
    {
        if (!$this->burgers->contains($burger)) {
            $this->burgers->add($burger);
        }

        return $this;
    }

    public function removeBurger(Burger $burger): static
    {
        $this->burgers->removeElement($burger);

        return $this;
    }
}
