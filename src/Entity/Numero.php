<?php

namespace App\Entity;

use App\Repository\NumeroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NumeroRepository::class)]
class Numero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $CodeN = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Titre = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Duree = null;

    #[ORM\Column]
    private ?int $CodeP = null;
    
    #[ORM\OneToMany(mappedBy: 'Presentateur', targetEntity: Presentateur::class)]
    private Collection $presentateurs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeN(): ?int
    {
        return $this->CodeN;
    }

    public function setCodeN(int $CodeN): self
    {
        $this->CodeN = $CodeN;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(?string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->Duree;
    }

    public function setDuree(?string $Duree): self
    {
        $this->Duree = $Duree;

        return $this;
    }

    public function getCodeP(): ?int
    {
        return $this->CodeP;
    }

    public function setCodeP(int $CodeP): self
    {
        $this->CodeP = $CodeP;

        return $this;
    }
}
