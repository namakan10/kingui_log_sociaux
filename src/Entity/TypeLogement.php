<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeLogementRepository")
 */
class TypeLogement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="float")
     */
    private $superficie;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbre_total;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbre_restant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Logement", mappedBy="type_logement")
     */
    private $logements;

    public function __construct()
    {
        $this->logements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSuperficie(): ?float
    {
        return $this->superficie;
    }

    public function setSuperficie(float $superficie): self
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getNbreTotal(): ?int
    {
        return $this->nbre_total;
    }

    public function setNbreTotal(int $nbre_total): self
    {
        $this->nbre_total = $nbre_total;

        return $this;
    }

    public function getNbreRestant(): ?int
    {
        return $this->nbre_restant;
    }

    public function setNbreRestant(int $nbre_restant): self
    {
        $this->nbre_restant = $nbre_restant;

        return $this;
    }

    /**
     * @return Collection|Logement[]
     */
    public function getLogements(): Collection
    {
        return $this->logements;
    }

    public function addLogement(Logement $logement): self
    {
        if (!$this->logements->contains($logement)) {
            $this->logements[] = $logement;
            $logement->setTypeLogement($this);
        }

        return $this;
    }

    public function removeLogement(Logement $logement): self
    {
        if ($this->logements->contains($logement)) {
            $this->logements->removeElement($logement);
            // set the owning side to null (unless already changed)
            if ($logement->getTypeLogement() === $this) {
                $logement->setTypeLogement(null);
            }
        }

        return $this;
    }
}
