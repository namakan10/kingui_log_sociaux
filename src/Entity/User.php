<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Offre", mappedBy="user")
     */
    private $offres;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Demandeur", cascade={"persist", "remove"}, mappedBy="user")
     */
    private $demandeur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Guichet", inversedBy="user")
     */
    private $guichet;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Historique", mappedBy="user", cascade={"persist", "remove"})
     */
    private $historique;


    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->offres = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return Collection|Offre[]
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offre $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres[] = $offre;
            $offre->setUser($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): self
    {
        if ($this->offres->contains($offre)) {
            $this->offres->removeElement($offre);
            // set the owning side to null (unless already changed)
            if ($offre->getUser() === $this) {
                $offre->setUser(null);
            }
        }

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
        $newUser = null === $demandeur ? null : $this;
        if ($demandeur->getUser() !== $newUser) {
            $demandeur->setUser($newUser);
        }

        return $this;
    }

    public function getGuichet(): ?Guichet
    {
        return $this->guichet;
    }

    public function setGuichet(?Guichet $guichet): self
    {
        $this->guichet = $guichet;

        return $this;
    }

    public function getHistorique(): ?Historique
    {
        return $this->historique;
    }

    public function setHistorique(Historique $historique): self
    {
        $this->historique = $historique;

        // set the owning side of the relation if necessary
        if ($historique->getUser() !== $this) {
            $historique->setUser($this);
        }

        return $this;
    }

}
