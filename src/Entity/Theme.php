<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ThemeRepository::class)
 */
class Theme
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="noms")
     */
    private $nom;

    public function __construct()
    {
        $this->nom = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Article[]
     */
    public function getNom(): Collection
    {
        return $this->nom;
    }

    public function addNom(Article $nom): self
    {
        if (!$this->nom->contains($nom)) {
            $this->nom[] = $nom;
            $nom->setNoms($this);
        }

        return $this;
    }

    public function removeNom(Article $nom): self
    {
        if ($this->nom->contains($nom)) {
            $this->nom->removeElement($nom);
            // set the owning side to null (unless already changed)
            if ($nom->getNoms() === $this) {
                $nom->setNoms(null);
            }
        }

        return $this;
    }
}
