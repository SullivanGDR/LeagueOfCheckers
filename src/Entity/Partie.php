<?php

namespace App\Entity;

use App\Repository\PartieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartieRepository::class)]
class Partie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbCoupJ1 = null;

    #[ORM\Column]
    private ?int $nbCoupJ2 = null;

    #[ORM\Column(length: 255)]
    private ?string $codePartie = null;

    #[ORM\Column]
    private ?bool $etatPartie = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $etatPlateau = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'gagner')]
    private Collection $users;

    #[ORM\ManyToOne(inversedBy: 'parties')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $joueur1 = null;

    #[ORM\ManyToOne(inversedBy: 'parties')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $joueur2 = null;

    #[ORM\ManyToMany(targetEntity: Deplacement::class, inversedBy: 'parties')]
    private Collection $realiser;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datePartie = null;

    #[ORM\ManyToOne(inversedBy: 'gagantPartie')]
    private ?User $gagnant = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->realiser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbCoupJ1(): ?int
    {
        return $this->nbCoupJ1;
    }

    public function setNbCoupJ1(int $nbCoupJ1): static
    {
        $this->nbCoupJ1 = $nbCoupJ1;

        return $this;
    }

    public function getNbCoupJ2(): ?int
    {
        return $this->nbCoupJ2;
    }

    public function setNbCoupJ2(int $nbCoupJ2): static
    {
        $this->nbCoupJ2 = $nbCoupJ2;

        return $this;
    }

    public function getCodePartie(): ?string
    {
        return $this->codePartie;
    }

    public function setCodePartie(string $codePartie): static
    {
        $this->codePartie = $codePartie;

        return $this;
    }

    public function isEtatPartie(): ?bool
    {
        return $this->etatPartie;
    }

    public function setEtatPartie(bool $etatPartie): static
    {
        $this->etatPartie = $etatPartie;

        return $this;
    }

    public function getEtatPlateau(): ?string
    {
        return $this->etatPlateau;
    }

    public function setEtatPlateau(string $etatPlateau): static
    {
        $this->etatPlateau = $etatPlateau;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addGagner($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeGagner($this);
        }

        return $this;
    }

    public function getJoueur1(): ?User
    {
        return $this->joueur1;
    }

    public function setJoueur1(?User $joueur1): static
    {
        $this->joueur1 = $joueur1;

        return $this;
    }

    public function getJoueur2(): ?User
    {
        return $this->joueur2;
    }

    public function setJoueur2(?User $joueur2): static
    {
        $this->joueur2 = $joueur2;

        return $this;
    }

    /**
     * @return Collection<int, Deplacement>
     */
    public function getRealiser(): Collection
    {
        return $this->realiser;
    }

    public function addRealiser(Deplacement $realiser): static
    {
        if (!$this->realiser->contains($realiser)) {
            $this->realiser->add($realiser);
        }

        return $this;
    }

    public function removeRealiser(Deplacement $realiser): static
    {
        $this->realiser->removeElement($realiser);

        return $this;
    }

    public function getDatePartie(): ?\DateTimeInterface
    {
        return $this->datePartie;
    }

    public function setDatePartie(\DateTimeInterface $datePartie): static
    {
        $this->datePartie = $datePartie;

        return $this;
    }

    public function getGagnant(): ?User
    {
        return $this->gagnant;
    }

    public function setGagnant(?User $gagnant): static
    {
        $this->gagnant = $gagnant;

        return $this;
    }
}
