<?php

namespace App\Entity;

use App\Repository\PartieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Patch;

#[ApiResource(operations:[
    new Patch()
])]
#[ORM\Entity(repositoryClass: PartieRepository::class)]
class Partie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datePartie = null;

    #[ORM\Column(nullable: true)]
    private ?array $etatPlateau = null;

    #[ORM\Column]
    private ?int $nbCoupJN = null;

    #[ORM\Column]
    private ?int $nbCoupJB = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $timer = null;

    #[ORM\Column]
    private ?int $nbTour = null;

    #[ORM\Column]
    private ?int $nbPionN = null;

    #[ORM\Column]
    private ?int $nbPionB = null;

    #[ORM\Column(length: 255)]
    private ?string $codePartie = null;

    #[ORM\ManyToOne(inversedBy: 'parties')]
    private ?Joueur $joueurB = null;

    #[ORM\ManyToOne(inversedBy: 'parties')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Joueur $joueurN = null;

    #[ORM\ManyToOne(inversedBy: 'parties')]
    private ?Joueur $winner = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEtatPlateau(): ?array
    {
        return $this->etatPlateau;
    }

    public function setEtatPlateau(?array $etatPlateau): static
    {
        $this->etatPlateau = $etatPlateau;

        return $this;
    }

    public function getNbCoupJN(): ?int
    {
        return $this->nbCoupJN;
    }

    public function setNbCoupJN(int $nbCoupJN): static
    {
        $this->nbCoupJN = $nbCoupJN;

        return $this;
    }

    public function getNbCoupJB(): ?int
    {
        return $this->nbCoupJB;
    }

    public function setNbCoupJB(int $nbCoupJB): static
    {
        $this->nbCoupJB = $nbCoupJB;

        return $this;
    }

    public function getTimer(): ?\DateTimeInterface
    {
        return $this->timer;
    }

    public function setTimer(?\DateTimeInterface $timer): static
    {
        $this->timer = $timer;

        return $this;
    }

    public function getNbTour(): ?int
    {
        return $this->nbTour;
    }

    public function setNbTour(int $nbTour): static
    {
        $this->nbTour = $nbTour;

        return $this;
    }

    public function getNbPionN(): ?int
    {
        return $this->nbPionN;
    }

    public function setNbPionN(int $nbPionN): static
    {
        $this->nbPionN = $nbPionN;

        return $this;
    }

    public function getNbPionB(): ?int
    {
        return $this->nbPionB;
    }

    public function setNbPionB(int $nbPionB): static
    {
        $this->nbPionB = $nbPionB;

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

    public function getJoueurB(): ?Joueur
    {
        return $this->joueurB;
    }

    public function setJoueurB(?Joueur $joueurB): static
    {
        $this->joueurB = $joueurB;

        return $this;
    }

    public function getJoueurN(): ?Joueur
    {
        return $this->joueurN;
    }

    public function setJoueurN(?Joueur $joueurN): static
    {
        $this->joueurN = $joueurN;

        return $this;
    }

    public function getWinner(): ?Joueur
    {
        return $this->winner;
    }

    public function setWinner(?Joueur $winner): static
    {
        $this->winner = $winner;

        return $this;
    }
}
