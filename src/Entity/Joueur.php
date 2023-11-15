<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(operations:[
    new Get(normalizationContext:['groups'=>'joueur:item'])
])]
#[ORM\Entity(repositoryClass: JoueurRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class Joueur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['joueur:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['joueur:item'])]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    #[Groups(['joueur:item'])]
    private ?int $nbVictoire = null;

    #[ORM\Column]
    #[Groups(['joueur:item'])]
    private ?int $nbDefaite = null;

    #[ORM\Column]
    #[Groups(['joueur:item'])]
    private ?int $nbTotalePartie = null;

    #[ORM\ManyToOne(inversedBy: 'joueurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rang $rang = null;

    #[ORM\ManyToOne(inversedBy: 'joueurs')]
    private ?ThemePion $themePion = null;

    #[ORM\OneToMany(mappedBy: 'joueurB', targetEntity: Partie::class)]
    private Collection $parties;

    #[ORM\OneToMany(mappedBy: 'joueur', targetEntity: Mouvement::class)]
    private Collection $mouvements;

    #[ORM\Column]
    #[Groups(['joueur:item'])]
    private ?int $monnaie = null;

    #[ORM\Column]
    private ?int $pointsRang = null;

    #[ORM\ManyToMany(targetEntity: ThemePion::class, mappedBy: 'joueur')]
    private Collection $themePions;

    public function __construct()
    {
        $this->parties = new ArrayCollection();
        $this->mouvements = new ArrayCollection();
        $this->themePions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNbVictoire(): ?int
    {
        return $this->nbVictoire;
    }

    public function setNbVictoire(int $nbVictoire): static
    {
        $this->nbVictoire = $nbVictoire;

        return $this;
    }

    public function getNbDefaite(): ?int
    {
        return $this->nbDefaite;
    }

    public function setNbDefaite(int $nbDefaite): static
    {
        $this->nbDefaite = $nbDefaite;

        return $this;
    }

    public function getNbTotalePartie(): ?int
    {
        return $this->nbTotalePartie;
    }

    public function setNbTotalePartie(int $nbTotalePartie): static
    {
        $this->nbTotalePartie = $nbTotalePartie;

        return $this;
    }

    public function getRang(): ?Rang
    {
        return $this->rang;
    }

    public function setRang(?Rang $rang): static
    {
        $this->rang = $rang;

        return $this;
    }

    public function getThemePion(): ?ThemePion
    {
        return $this->themePion;
    }

    public function setThemePion(?ThemePion $themePion): static
    {
        $this->themePion = $themePion;

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
            $party->setJoueurB($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): static
    {
        if ($this->parties->removeElement($party)) {
            // set the owning side to null (unless already changed)
            if ($party->getJoueurB() === $this) {
                $party->setJoueurB(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mouvement>
     */
    public function getMouvements(): Collection
    {
        return $this->mouvements;
    }

    public function addMouvement(Mouvement $mouvement): static
    {
        if (!$this->mouvements->contains($mouvement)) {
            $this->mouvements->add($mouvement);
            $mouvement->setJoueur($this);
        }

        return $this;
    }

    public function removeMouvement(Mouvement $mouvement): static
    {
        if ($this->mouvements->removeElement($mouvement)) {
            // set the owning side to null (unless already changed)
            if ($mouvement->getJoueur() === $this) {
                $mouvement->setJoueur(null);
            }
        }

        return $this;
    }

    public function getMonnaie(): ?int
    {
        return $this->monnaie;
    }

    public function setMonnaie(int $monnaie): static
    {
        $this->monnaie = $monnaie;

        return $this;
    }

    public function getPointsRang(): ?int
    {
        return $this->pointsRang;
    }

    public function setPointsRang(int $pointsRang): static
    {
        $this->pointsRang = $pointsRang;

        return $this;
    }

    /**
     * @return Collection<int, ThemePion>
     */
    public function getThemePions(): Collection
    {
        return $this->themePions;
    }

    public function addThemePion(ThemePion $themePion): static
    {
        if (!$this->themePions->contains($themePion)) {
            $this->themePions->add($themePion);
            $themePion->addJoueur($this);
        }

        return $this;
    }

    public function removeThemePion(ThemePion $themePion): static
    {
        if ($this->themePions->removeElement($themePion)) {
            $themePion->removeJoueur($this);
        }

        return $this;
    }
}
