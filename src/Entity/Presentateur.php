<?php

namespace App\Entity;

use App\Repository\PresentateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PresentateurRepository::class)]
class Presentateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $CodeP = null;

    #[ORM\Column(length: 50)]
    private ?string $NomP = null;

    #[ORM\Column]
    private ?int $CodeR = null;

    #[ORM\ManyToOne(targetEntity: Role::class, inversedBy: 'presentateurs')]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'id', nullable: false)]
    private ?Role $role = null;

    #[ORM\ManyToOne(targetEntity: Numero::class, inversedBy: 'presentateurs')]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'id', nullable: false)]
    private Collection $numero;

    public function __construct()
    {
        $this->numero = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNomP(): ?string
    {
        return $this->NomP;
    }

    public function setNomP(string $NomP): self
    {
        $this->NomP = $NomP;

        return $this;
    }

    public function getCodeR(): ?int
    {
        return $this->CodeR;
    }

    public function setCodeR(int $CodeR): self
    {
        $this->CodeR = $CodeR;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Numero>
     */
    public function getNumero(): Collection
    {
        return $this->numero;
    }

    public function addNumero(Numero $numero): self
    {
        if (!$this->numero->contains($numero)) {
            $this->numero->add($numero);
        }

        return $this;
    }

    public function removeNumero(Numero $numero): self
    {
        $this->numero->removeElement($numero);

        return $this;
    }


    public function __toString()
    {
        return $this->CodeN;
    }

}
