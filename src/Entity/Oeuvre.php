<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Oeuvre
 *
 * @ORM\Table(name="oeuvre")
 * @ORM\Entity
 */
class Oeuvre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_oeuvre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOeuvre;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_oeuvre", type="string", length=100, nullable=false)
     */
    private $nomOeuvre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="PrixOeuvre", mappedBy="idOeuvre")
     */
    private $idPrixOeuvre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Auteur", mappedBy="idOeuvre")
     */
    private $idAuteur;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPrixOeuvre = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idAuteur = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdOeuvre(): ?int
    {
        return $this->idOeuvre;
    }

    public function getNomOeuvre(): ?string
    {
        return $this->nomOeuvre;
    }

    public function setNomOeuvre(string $nomOeuvre): self
    {
        $this->nomOeuvre = $nomOeuvre;

        return $this;
    }

    /**
     * @return Collection|PrixOeuvre[]
     */
    public function getIdPrixOeuvre(): Collection
    {
        return $this->idPrixOeuvre;
    }

    public function addIdPrixOeuvre(PrixOeuvre $idPrixOeuvre): self
    {
        if (!$this->idPrixOeuvre->contains($idPrixOeuvre)) {
            $this->idPrixOeuvre[] = $idPrixOeuvre;
            $idPrixOeuvre->addIdOeuvre($this);
        }

        return $this;
    }

    public function removeIdPrixOeuvre(PrixOeuvre $idPrixOeuvre): self
    {
        if ($this->idPrixOeuvre->contains($idPrixOeuvre)) {
            $this->idPrixOeuvre->removeElement($idPrixOeuvre);
            $idPrixOeuvre->removeIdOeuvre($this);
        }

        return $this;
    }

    /**
     * @return Collection|Auteur[]
     */
    public function getIdAuteur(): Collection
    {
        return $this->idAuteur;
    }

    public function addIdAuteur(Auteur $idAuteur): self
    {
        if (!$this->idAuteur->contains($idAuteur)) {
            $this->idAuteur[] = $idAuteur;
            $idAuteur->addIdOeuvre($this);
        }

        return $this;
    }

    public function removeIdAuteur(Auteur $idAuteur): self
    {
        if ($this->idAuteur->contains($idAuteur)) {
            $this->idAuteur->removeElement($idAuteur);
            $idAuteur->removeIdOeuvre($this);
        }

        return $this;
    }

    public function __toString() {
        return $this->getNomOeuvre();
    }
}
