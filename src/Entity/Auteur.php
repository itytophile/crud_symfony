<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Auteur
 *
 * @ORM\Table(name="auteur")
 * @ORM\Entity
 */
class Auteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_auteur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAuteur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_auteur", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $nomAuteur = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom_auteur", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $prenomAuteur = 'NULL';

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="PrixAuteur", mappedBy="idAuteur")
     */
    private $idPrixAuteur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Oeuvre", inversedBy="idAuteur")
     * @ORM\JoinTable(name="ecriture",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_auteur", referencedColumnName="id_auteur")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_oeuvre", referencedColumnName="id_oeuvre")
     *   }
     * )
     */
    private $idOeuvre;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPrixAuteur = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idOeuvre = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdAuteur(): ?int
    {
        return $this->idAuteur;
    }

    public function getNomAuteur(): ?string
    {
        return $this->nomAuteur;
    }

    public function setNomAuteur(?string $nomAuteur): self
    {
        $this->nomAuteur = $nomAuteur;

        return $this;
    }

    public function getPrenomAuteur(): ?string
    {
        return $this->prenomAuteur;
    }

    public function setPrenomAuteur(?string $prenomAuteur): self
    {
        $this->prenomAuteur = $prenomAuteur;

        return $this;
    }

    /**
     * @return Collection|PrixAuteur[]
     */
    public function getIdPrixAuteur(): Collection
    {
        return $this->idPrixAuteur;
    }

    public function addIdPrixAuteur(PrixAuteur $idPrixAuteur): self
    {
        if (!$this->idPrixAuteur->contains($idPrixAuteur)) {
            $this->idPrixAuteur[] = $idPrixAuteur;
            $idPrixAuteur->addIdAuteur($this);
        }

        return $this;
    }

    public function removeIdPrixAuteur(PrixAuteur $idPrixAuteur): self
    {
        if ($this->idPrixAuteur->contains($idPrixAuteur)) {
            $this->idPrixAuteur->removeElement($idPrixAuteur);
            $idPrixAuteur->removeIdAuteur($this);
        }

        return $this;
    }

    /**
     * @return Collection|Oeuvre[]
     */
    public function getIdOeuvre(): Collection
    {
        return $this->idOeuvre;
    }

    public function addIdOeuvre(Oeuvre $idOeuvre): self
    {
        if (!$this->idOeuvre->contains($idOeuvre)) {
            $this->idOeuvre[] = $idOeuvre;
        }

        return $this;
    }

    public function removeIdOeuvre(Oeuvre $idOeuvre): self
    {
        if ($this->idOeuvre->contains($idOeuvre)) {
            $this->idOeuvre->removeElement($idOeuvre);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNomAuteur()." ".$this->getPrenomAuteur();
    }
}
