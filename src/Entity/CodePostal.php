<?php

namespace App\Entity;

use App\Repository\CodePostalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CodePostalRepository::class)
 */
class CodePostal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Ville::class, mappedBy="code_postal")
     */
    private $villes;

    /**
     * @ORM\OneToMany(targetEntity=Society::class, mappedBy="code_postal")
     */
    private $societies;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
        $this->societies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Ville[]
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Ville $ville): self
    {
        if (!$this->villes->contains($ville)) {
            $this->villes[] = $ville;
            $ville->setCodePostal($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): self
    {
        if ($this->villes->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getCodePostal() === $this) {
                $ville->setCodePostal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Society[]
     */
    public function getSocieties(): Collection
    {
        return $this->societies;
    }

    public function addSociety(Society $society): self
    {
        if (!$this->societies->contains($society)) {
            $this->societies[] = $society;
            $society->setCodePostal($this);
        }

        return $this;
    }

    public function removeSociety(Society $society): self
    {
        if ($this->societies->removeElement($society)) {
            // set the owning side to null (unless already changed)
            if ($society->getCodePostal() === $this) {
                $society->setCodePostal(null);
            }
        }

        return $this;
    }
}
