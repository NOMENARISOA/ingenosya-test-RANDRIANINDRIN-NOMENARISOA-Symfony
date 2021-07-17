<?php

namespace App\Entity;

use App\Repository\TypeSocietyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeSocietyRepository::class)
 */
class TypeSociety
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
     * @ORM\ManyToMany(targetEntity=Society::class, mappedBy="type_society")
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
            $society->addTypeSociety($this);
        }

        return $this;
    }

    public function removeSociety(Society $society): self
    {
        if ($this->societies->removeElement($society)) {
            $society->removeTypeSociety($this);
        }

        return $this;
    }

    
}
