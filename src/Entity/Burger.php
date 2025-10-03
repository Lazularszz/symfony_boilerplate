<?php

namespace App\Entity;

use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
class Burger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'burgers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pain $pain = null;

    #[ORM\ManyToMany(targetEntity: Oignon::class, inversedBy: 'burgers')]
    private Collection $oignons;

    #[ORM\ManyToMany(targetEntity: Sauce::class, inversedBy: 'burgers')]
    private Collection $sauces;

    #[ORM\ManyToMany(targetEntity: Fromage::class, inversedBy: 'burgers')]
    private Collection $fromages;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Image $image = null;

    #[ORM\OneToMany(mappedBy: 'burger', targetEntity: Commentaire::class)]
    private Collection $commentaires;

    public function __construct()
    {
        $this->oignons = new ArrayCollection();
        $this->sauces = new ArrayCollection();
        $this->fromages = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPain(): ?Pain
    {
        return $this->pain;
    }

    public function setPain(?Pain $pain): static
    {
        $this->pain = $pain;

        return $this;
    }

    /**
     * @return Collection<int, Oignon>
     */
    public function getOignons(): Collection
    {
        return $this->oignons;
    }

    public function addOignon(Oignon $oignon): static
    {
        if (!$this->oignons->contains($oignon)) {
            $this->oignons->add($oignon);
        }

        return $this;
    }

    public function removeOignon(Oignon $oignon): static
    {
        $this->oignons->removeElement($oignon);

        return $this;
    }

    /**
     * @return Collection<int, Sauce>
     */
    public function getSauces(): Collection
    {
        return $this->sauces;
    }

    public function addSauce(Sauce $sauce): static
    {
        if (!$this->sauces->contains($sauce)) {
            $this->sauces->add($sauce);
        }

        return $this;
    }

    public function removeSauce(Sauce $sauce): static
    {
        $this->sauces->removeElement($sauce);

        return $this;
    }

    /**
     * @return Collection<int, Fromage>
     */
    public function getFromages(): Collection
    {
        return $this->fromages;
    }

    public function addFromage(Fromage $fromage): static
    {
        if (!$this->fromages->contains($fromage)) {
            $this->fromages->add($fromage);
        }

        return $this;
    }

    public function removeFromage(Fromage $fromage): static
    {
        $this->fromages->removeElement($fromage);

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setBurger($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getBurger() === $this) {
                $commentaire->setBurger(null);
            }
        }

        return $this;
    }
}
