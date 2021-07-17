<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
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
     * @ORM\ManyToOne(targetEntity=CodePostal::class, inversedBy="villes")
     */
    private $code_postal;

    /**
     * @ORM\OneToMany(targetEntity=Society::class, mappedBy="ville")
     */
    private $societies;

    public function __construct()
    {
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

    public function getCodePostal(): ?CodePostal
    {
        return $this->code_postal;
    }

    public function setCodePostal(?CodePostal $code_postal): self
    {
        $this->code_postal = $code_postal;

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
            $society->setVille($this);
        }

        return $this;
    }

    public function removeSociety(Society $society): self
    {
        if ($this->societies->removeElement($society)) {
            // set the owning side to null (unless already changed)
            if ($society->getVille() === $this) {
                $society->setVille(null);
            }
        }

        return $this;
    }

    public function toArray()
    {   
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'code_postal' => $this->getCodePostal(),
        ];
    }
}
