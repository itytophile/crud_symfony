<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PrixOeuvre
 *
 * @ORM\Table(name="prix_oeuvre")
 * @ORM\Entity
 */
class PrixOeuvre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_prix_oeuvre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPrixOeuvre;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_prix_oeuvre", type="string", length=50, nullable=false)
     */
    private $nomPrixOeuvre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Oeuvre", inversedBy="idPrixOeuvre")
     * @ORM\JoinTable(name="attribution_prix_oeuvre",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_prix_oeuvre", referencedColumnName="id_prix_oeuvre")
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
        $this->idOeuvre = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdPrixOeuvre(): ?int
    {
        return $this->idPrixOeuvre;
    }

    public function getNomPrixOeuvre(): ?string
    {
        return $this->nomPrixOeuvre;
    }

    public function setNomPrixOeuvre(string $nomPrixOeuvre): self
    {
        $this->nomPrixOeuvre = $nomPrixOeuvre;

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
        return $this->getNomPrixOeuvre();
    }
}
