<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column]
    private ?int $nbVictoire = null;

    #[ORM\Column]
    private ?int $nbDefaite = null;

    #[ORM\Column]
    private ?int $nbTotalPartie = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rang $rang = null;

    #[ORM\ManyToMany(targetEntity: Partie::class, inversedBy: 'users')]
    private Collection $gagner;

    #[ORM\OneToMany(mappedBy: 'joueur1', targetEntity: Partie::class)]
    private Collection $parties;

    #[ORM\OneToMany(mappedBy: 'executer', targetEntity: Mouvement::class)]
    private Collection $mouvements;

  /**
     * Many Users have Many Users.
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'myFriends')]
    private Collection $friendsWithMe;

    /**
     * Many Users have many Users.
     * @var Collection<int, User>
     */
   
    private Collection $myFriends;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\OneToMany(mappedBy: 'gagnant', targetEntity: Partie::class)]
    private Collection $gagantPartie;

  

    public function __construct()
    {
        $this->friendsWithMe = new ArrayCollection();
        $this->myFriends = new ArrayCollection();
        $this->gagner = new ArrayCollection();
        $this->parties = new ArrayCollection();
        $this->mouvements = new ArrayCollection();
        $this->amis = new ArrayCollection();
        $this->demandes = new ArrayCollection();
        $this->gagantPartie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
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
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
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

    public function getNbTotalPartie(): ?int
    {
        return $this->nbTotalPartie;
    }

    public function setNbTotalPartie(int $nbTotalPartie): static
    {
        $this->nbTotalPartie = $nbTotalPartie;

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

    /**
     * @return Collection<int, Partie>
     */
    public function getGagner(): Collection
    {
        return $this->gagner;
    }

    public function addGagner(Partie $gagner): static
    {
        if (!$this->gagner->contains($gagner)) {
            $this->gagner->add($gagner);
        }

        return $this;
    }

    public function removeGagner(Partie $gagner): static
    {
        $this->gagner->removeElement($gagner);

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
            $party->setJoueur1($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): static
    {
        if ($this->parties->removeElement($party)) {
            // set the owning side to null (unless already changed)
            if ($party->getJoueur1() === $this) {
                $party->setJoueur1(null);
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
            $mouvement->setExecuter($this);
        }

        return $this;
    }

    public function removeMouvement(Mouvement $mouvement): static
    {
        if ($this->mouvements->removeElement($mouvement)) {
            // set the owning side to null (unless already changed)
            if ($mouvement->getExecuter() === $this) {
                $mouvement->setExecuter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAmis(): Collection
    {
        return $this->amis;
    }

    public function addAmi(self $ami): static
    {
        if (!$this->amis->contains($ami)) {
            $this->amis->add($ami);
        }

        return $this;
    }

    public function removeAmi(self $ami): static
    {
        $this->amis->removeElement($ami);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(self $demande): static
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes->add($demande);
            $demande->addAmi($this);
        }

        return $this;
    }

    public function removeDemande(self $demande): static
    {
        if ($this->demandes->removeElement($demande)) {
            $demande->removeAmi($this);
        }

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): static
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * @return Collection<int, Partie>
     */
    public function getGagantPartie(): Collection
    {
        return $this->gagantPartie;
    }

    public function addGagantPartie(Partie $gagantPartie): static
    {
        if (!$this->gagantPartie->contains($gagantPartie)) {
            $this->gagantPartie->add($gagantPartie);
            $gagantPartie->setGagnant($this);
        }

        return $this;
    }

    public function removeGagantPartie(Partie $gagantPartie): static
    {
        if ($this->gagantPartie->removeElement($gagantPartie)) {
            // set the owning side to null (unless already changed)
            if ($gagantPartie->getGagnant() === $this) {
                $gagantPartie->setGagnant(null);
            }
        }

        return $this;
    }
}
