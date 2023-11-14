<?php

namespace App\Entity;

use App\Repository\DeplacementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

#[ApiResource(operations:[
    new Post(normalizationContext:['groups'=>'deplacement:item']),
    new GetCollection(normalizationContext:['groups'=>'deplacement:list'])
])]
#[ApiFilter(SearchFilter::class, properties: ['parties'=>"exact"])]
#[ORM\Entity(repositoryClass: DeplacementRepository::class)]
class Deplacement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['deplacement:item'])]
    private ?int $emplacementX = null;

    #[ORM\Column]
    #[Groups(['deplacement:item'])]
    private ?int $emplacementY = null;

    #[ORM\Column]
    #[Groups(['deplacement:item'])]
    private ?int $arriveX = null;

    #[ORM\Column]
    #[Groups(['deplacement:item'])]
    private ?int $arriveY = null;

    #[ORM\ManyToOne(inversedBy: 'deplacements')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['deplacement:list','deplacement:item'])]
    private ?Mouvement $mouvement = null;

    #[ORM\ManyToMany(targetEntity: Partie::class, mappedBy: 'deplacement')]
    #[Groups(['deplacement:item'])]
    private Collection $parties;

    public function __construct()
    {
        $this->parties = new ArrayCollection();
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

    public function getMouvement(): ?Mouvement
    {
        return $this->mouvement;
    }

    public function setMouvement(?Mouvement $mouvement): static
    {
        $this->mouvement = $mouvement;

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
            $party->addDeplacement($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): static
    {
        if ($this->parties->removeElement($party)) {
            $party->removeDeplacement($this);
        }

        return $this;
    }
}
