<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $CodeR = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Libelle = null;

    #[ORM\Column(nullable: true)]
    private ?int $Prix = null;

    #[ORM\OneToMany(mappedBy: 'Presentateur', targetEntity: Presentateur::class)]
    private Collection $presentateurs;

    public function __construct()
    {
        $this->presentateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(?string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->Prix;
    }

    public function setPrix(?int $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    /**
     * @return Collection<int, Presentateur>
     */
    public function getPresentateurs(): Collection
    {
        return $this->presentateurs;
    }

    public function addPresentateur(Presentateur $presentateur): self
    {
        if (!$this->presentateurs->contains($presentateur)) {
            $this->presentateurs->add($presentateur);
            $presentateur->setRole($this);
        }

        return $this;
    }

    public function removePresentateur(Presentateur $presentateur): self
    {
        if ($this->presentateurs->removeElement($presentateur)) {
            // set the owning side to null (unless already changed)
            if ($presentateur->getRole() === $this) {
                $presentateur->setRole(null);
            }
        }

        return $this;
    }
}
