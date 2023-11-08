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

    #[ORM\Column]
    private ?int $emplacementX = null;

    #[ORM\Column]
    private ?int $emplacementY = null;

    #[ORM\Column]
    private ?int $arriveX = null;

    #[ORM\Column]
    private ?int $arriveY = null;

    #[ORM\Column(length: 255)]
    private ?string $typeMouv = null;

    #[ORM\OneToMany(mappedBy: 'mouvement', targetEntity: Deplacement::class, orphanRemoval: true)]
    private Collection $deplacements;

    #[ORM\ManyToOne(inversedBy: 'mouvements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Joueur $joueur = null;

    public function __construct()
    {
        $this->deplacements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmplacementX(): ?int
    {
        return $this->emplacementX;
    }

    public function setEmplacementX(int $emplacementX): static
    {
        $this->emplacementX = $emplacementX;

        return $this;
    }

    public function getEmplacementY(): ?int
    {
        return $this->emplacementY;
    }

    public function setEmplacementY(int $emplacementY): static
    {
        $this->emplacementY = $emplacementY;

        return $this;
    }

    public function getArriveX(): ?int
    {
        return $this->arriveX;
    }

    public function setArriveX(int $arriveX): static
    {
        $this->arriveX = $arriveX;

        return $this;
    }

    public function getArriveY(): ?int
    {
        return $this->arriveY;
    }

    public function setArriveY(int $arriveY): static
    {
        $this->arriveY = $arriveY;

        return $this;
    }

    public function getTypeMouv(): ?string
    {
        return $this->typeMouv;
    }

    public function setTypeMouv(string $typeMouv): static
    {
        $this->typeMouv = $typeMouv;

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
            $deplacement->setMouvement($this);
        }

        return $this;
    }

    public function removeDeplacement(Deplacement $deplacement): static
    {
        if ($this->deplacements->removeElement($deplacement)) {
            // set the owning side to null (unless already changed)
            if ($deplacement->getMouvement() === $this) {
                $deplacement->setMouvement(null);
            }
        }

        return $this;
    }

    public function getJoueur(): ?Joueur
    {
        return $this->joueur;
    }

    public function setJoueur(?Joueur $joueur): static
    {
        $this->joueur = $joueur;

        return $this;
    }
}
