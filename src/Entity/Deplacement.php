<?php

namespace App\Entity;

use App\Repository\DeplacementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeplacementRepository::class)]
class Deplacement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $emplacementX = null;

    #[ORM\Column(length: 255)]
    private ?string $emplacementY = null;

    #[ORM\Column(length: 255)]
    private ?string $arriveeX = null;

    #[ORM\Column(length: 255)]
    private ?string $arriveeY = null;

    #[ORM\ManyToMany(targetEntity: Partie::class, mappedBy: 'realiser')]
    private Collection $parties;

    #[ORM\ManyToOne(inversedBy: 'deplacements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mouvement $posseder = null;

    public function __construct()
    {
        $this->parties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmplacementX(): ?string
    {
        return $this->emplacementX;
    }

    public function setEmplacementX(string $emplacementX): static
    {
        $this->emplacementX = $emplacementX;

        return $this;
    }

    public function getEmplacementY(): ?string
    {
        return $this->emplacementY;
    }

    public function setEmplacementY(string $emplacementY): static
    {
        $this->emplacementY = $emplacementY;

        return $this;
    }

    public function getArriveeX(): ?string
    {
        return $this->arriveeX;
    }

    public function setArriveeX(string $arriveeX): static
    {
        $this->arriveeX = $arriveeX;

        return $this;
    }

    public function getArriveeY(): ?string
    {
        return $this->arriveeY;
    }

    public function setArriveeY(string $arriveeY): static
    {
        $this->arriveeY = $arriveeY;

        return $this;
    }

    /**
     * @return Collection<int, Partie>
     */
    public function getParties(): Collection
    {
        return $this->parties;
    }

    public function addParty(Partie $party): static
    {
        if (!$this->parties->contains($party)) {
            $this->parties->add($party);
            $party->addRealiser($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): static
    {
        if ($this->parties->removeElement($party)) {
            $party->removeRealiser($this);
        }

        return $this;
    }

    public function getPosseder(): ?Mouvement
    {
        return $this->posseder;
    }

    public function setPosseder(?Mouvement $posseder): static
    {
        $this->posseder = $posseder;

        return $this;
    }
}
