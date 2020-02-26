<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionRepository")
 */
class Region
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
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Offre", inversedBy="regions")
     */
    private $offre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Guichet", mappedBy="region")
     */
    private $guichets;

    public function __construct()
    {
        $this->offre = new ArrayCollection();
        $this->guichets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Offre[]
     */
    public function getOffre(): Collection
    {
        return $this->offre;
    }

    public function addOffre(Offre $offre): self
    {
        if (!$this->offre->contains($offre)) {
            $this->offre[] = $offre;
        }

        return $this;
    }

    public function removeOffre(Offre $offre): self
    {
        if ($this->offre->contains($offre)) {
            $this->offre->removeElement($offre);
        }

        return $this;
    }

    /**
     * @return Collection|Guichet[]
     */
    public function getGuichets(): Collection
    {
        return $this->guichets;
    }

    public function addGuichet(Guichet $guichet): self
    {
        if (!$this->guichets->contains($guichet)) {
            $this->guichets[] = $guichet;
            $guichet->setRegion($this);
        }

        return $this;
    }

    public function removeGuichet(Guichet $guichet): self
    {
        if ($this->guichets->contains($guichet)) {
            $this->guichets->removeElement($guichet);
            // set the owning side to null (unless already changed)
            if ($guichet->getRegion() === $this) {
                $guichet->setRegion(null);
            }
        }

        return $this;
    }
}
