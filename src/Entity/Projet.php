<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjetRepository::class)
 */
class Projet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titreProjet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $anneeProjet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $locationProjet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $createur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $client;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageAffichageProjet;

    /**
     * @ORM\OneToMany(targetEntity=ImageProjet::class, mappedBy="projet", orphanRemoval=true)
     */
    private $imageProjets;

    public function __construct()
    {
        $this->showImageProjet = new ArrayCollection();
        $this->imageProjets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreProjet(): ?string
    {
        return $this->titreProjet;
    }

    public function setTitreProjet(?string $titreProjet): self
    {
        $this->titreProjet = $titreProjet;

        return $this;
    }

    public function getAnneeProjet(): ?string
    {
        return $this->anneeProjet;
    }

    public function setAnneeProjet(?string $anneeProjet): self
    {
        $this->anneeProjet = $anneeProjet;

        return $this;
    }

    public function getLocationProjet(): ?string
    {
        return $this->locationProjet;
    }

    public function setLocationProjet(?string $locationProjet): self
    {
        $this->locationProjet = $locationProjet;

        return $this;
    }


    public function getCreateur(): ?string
    {
        return $this->createur;
    }

    public function setCreateur(?string $createur): self
    {
        $this->createur = $createur;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(?string $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getImageAffichageProjet(): ?string
    {
        return $this->imageAffichageProjet;
    }

    public function setImageAffichageProjet(?string $imageAffichageProjet): self
    {
        $this->imageAffichageProjet = $imageAffichageProjet;

        return $this;
    }

    /**
     * @return Collection|ImageProjet[]
     */
    public function getImageProjets(): Collection
    {
        return $this->imageProjets;
    }

    public function addImageProjet(ImageProjet $imageProjet): self
    {
        if (!$this->imageProjets->contains($imageProjet)) {
            $this->imageProjets[] = $imageProjet;
            $imageProjet->setProjet($this);
        }

        return $this;
    }

    public function removeImageProjet(ImageProjet $imageProjet): self
    {
        if ($this->imageProjets->removeElement($imageProjet)) {
            // set the owning side to null (unless already changed)
            if ($imageProjet->getProjet() === $this) {
                $imageProjet->setProjet(null);
            }
        }

        return $this;
    }
}
