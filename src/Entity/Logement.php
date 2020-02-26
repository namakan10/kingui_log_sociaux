<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LogementRepository")
 */
class Logement
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
    private $statut;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code_logement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Offre", inversedBy="logements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offre;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Demandeur", mappedBy="logement", cascade={"persist", "remove"})
     */
    private $demandeur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeLogement", inversedBy="logements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_logement;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

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

    public function getCodeLogement(): ?string
    {
        return $this->code_logement;
    }

    public function setCodeLogement(string $code_logement): self
    {
        $this->code_logement = $code_logement;

        return $this;
    }

    public function getOffre(): ?Offre
    {
        return $this->offre;
    }

    public function setOffre(?Offre $offre): self
    {
        $this->offre = $offre;

        return $this;
    }

    public function getDemandeur(): ?Demandeur
    {
        return $this->demandeur;
    }

    public function setDemandeur(?Demandeur $demandeur): self
    {
        $this->demandeur = $demandeur;

        // set (or unset) the owning side of the relation if necessary
        $newLogement = null === $demandeur ? null : $this;
        if ($demandeur->getLogement() !== $newLogement) {
            $demandeur->setLogement($newLogement);
        }

        return $this;
    }

    public function getTypeLogement(): ?TypeLogement
    {
        return $this->type_logement;
    }

    public function setTypeLogement(?TypeLogement $type_logement): self
    {
        $this->type_logement = $type_logement;

        return $this;
    }

}
