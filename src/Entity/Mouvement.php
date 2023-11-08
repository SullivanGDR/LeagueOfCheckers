<?php

namespace App\Entity;

use App\Repository\MouvementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MouvementRepository::class)]
class Mouvement
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

    #[ORM\Column(length: 255)]
    private ?string $typeMouvement = null;

    #[ORM\OneToMany(mappedBy: 'posseder', targetEntity: Deplacement::class, orphanRemoval: true)]
    private Collection $deplacements;

    #[ORM\ManyToOne(inversedBy: 'mouvements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $executer = null;

    public function __construct()
    {
        $this->deplacements = new ArrayCollection();
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

    public function getTypeMouvement(): ?string
    {
        return $this->typeMouvement;
    }

    public function setTypeMouvement(string $typeMouvement): static
    {
        $this->typeMouvement = $typeMouvement;

        return $this;
    }

    /**
     * @return Collection<int, Deplacement>
     */
    public function getDeplacements(): Collection
    {
        return $this->deplacements;
    }

    public function addDeplacement(Deplacement $deplacement): static
    {
        if (!$this->deplacements->contains($deplacement)) {
            $this->deplacements->add($deplacement);
            $deplacement->setPosseder($this);
        }

        return $this;
    }

    public function removeDeplacement(Deplacement $deplacement): static
    {
        if ($this->deplacements->removeElement($deplacement)) {
            // set the owning side to null (unless already changed)
            if ($deplacement->getPosseder() === $this) {
                $deplacement->setPosseder(null);
            }
        }

        return $this;
    }

    public function getExecuter(): ?User
    {
        return $this->executer;
    }

    public function setExecuter(?User $executer): static
    {
        $this->executer = $executer;

        return $this;
    }
}
