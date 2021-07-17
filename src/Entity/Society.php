<?php

namespace App\Entity;

use App\Repository\SocietyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SocietyRepository::class)
 */
class Society
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=TypeSociety::class, inversedBy="societies")
     */
    private $type_society;

    /**
     * @ORM\ManyToOne(targetEntity=CodePostal::class, inversedBy="societies")
     */
    private $code_postal;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="societies")
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity=Dirigeant::class, mappedBy="society")
     */
    private $dirigeants;

    public function __construct()
    {
        $this->type_society = new ArrayCollection();
        $this->dirigeants = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|TypeSociety[]
     */
    public function getTypeSociety(): Collection
    {
        return $this->type_society;
    }

    public function addTypeSociety(TypeSociety $typeSociety): self
    {
        if (!$this->type_society->contains($typeSociety)) {
            $this->type_society[] = $typeSociety;
        }

        return $this;
    }

    public function removeTypeSociety(TypeSociety $typeSociety): self
    {
        $this->type_society->removeElement($typeSociety);

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

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection|Dirigeant[]
     */
    public function getDirigeants(): Collection
    {
        return $this->dirigeants;
    }

    public function addDirigeant(Dirigeant $dirigeant): self
    {
        if (!$this->dirigeants->contains($dirigeant)) {
            $this->dirigeants[] = $dirigeant;
            $dirigeant->setSociety($this);
        }

        return $this;
    }

    public function removeDirigeant(Dirigeant $dirigeant): self
    {
        if ($this->dirigeants->removeElement($dirigeant)) {
            // set the owning side to null (unless already changed)
            if ($dirigeant->getSociety() === $this) {
                $dirigeant->setSociety(null);
            }
        }

        return $this;
    }
}
