<?php

namespace App\Entity;

use App\Repository\DeplacementRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;

#[ApiResource(operations:[
    new Post()
])]
#[ORM\Entity(repositoryClass: DeplacementRepository::class)]
class Deplacement
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

    #[ORM\ManyToOne(inversedBy: 'deplacements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mouvement $mouvement = null;

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

    public function getMouvement(): ?Mouvement
    {
        return $this->mouvement;
    }

    public function setMouvement(?Mouvement $mouvement): static
    {
        $this->mouvement = $mouvement;

        return $this;
    }
}
