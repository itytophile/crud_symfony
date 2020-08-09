<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PrixAuteur
 *
 * @ORM\Table(name="prix_auteur")
 * @ORM\Entity
 */
class PrixAuteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_prix_auteur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPrixAuteur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_prix_auteur", type="string", length=50, nullable=false)
     */
    private $nomPrixAuteur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Auteur", inversedBy="idPrixAuteur")
     * @ORM\JoinTable(name="attribution_prix_auteur",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_prix_auteur", referencedColumnName="id_prix_auteur")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_auteur", referencedColumnName="id_auteur")
     *   }
     * )
     */
    private $idAuteur;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idAuteur = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdPrixAuteur(): ?int
    {
        return $this->idPrixAuteur;
    }

    public function getNomPrixAuteur(): ?string
    {
        return $this->nomPrixAuteur;
    }

    public function setNomPrixAuteur(string $nomPrixAuteur): self
    {
        $this->nomPrixAuteur = $nomPrixAuteur;

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
        }

        return $this;
    }

    public function removeIdAuteur(Auteur $idAuteur): self
    {
        if ($this->idAuteur->contains($idAuteur)) {
            $this->idAuteur->removeElement($idAuteur);
        }

        return $this;
    }

    public function __toString() {
        return $this->getNomPrixAuteur();
    }
}
