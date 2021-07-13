<?php

namespace App\Entity;

use App\Repository\SocieteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SocieteRepository::class)
 */
class Societe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nom;

    private $postal;
    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=TypeSociete::class)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="societes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ville;

    public function __construct()
    {
        $this->type = new ArrayCollection();
        $this->code_postal = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $string): self
    {
        $this->nom = $string;
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

    /**
     * @return Collection|TypeSociete[]
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(TypeSociete $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
        }

        return $this;
    }

    public function removeType(TypeSociete $type): self
    {
        $this->type->removeElement($type);

        return $this;
    }

    /**
     * @return Collection|CodePostal[]
     */
    public function getCodePostal(): Collection
    {
        return $this->code_postal;
    }

    public function addCodePostal(CodePostal $codePostal): self
    {
        if (!$this->code_postal->contains($codePostal)) {
            $this->code_postal[] = $codePostal;
            $codePostal->setSocietes($this);
        }

        return $this;
    }

    public function removeCodePostal(CodePostal $codePostal): self
    {
        if ($this->code_postal->removeElement($codePostal)) {
            // set the owning side to null (unless already changed)
            if ($codePostal->getSocietes() === $this) {
                $codePostal->setSocietes(null);
            }
        }

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostal()
    {
        return $this->postal;
    }

    /**
     * @param mixed $postal
     */
    public function setPostal($postal): void
    {
        $this->postal = $postal;
    }


}
