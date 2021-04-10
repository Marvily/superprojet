<?php

namespace App\Entity;

use App\Repository\DisciplineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DisciplineRepository::class)
 */
class Discipline
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $niveau;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Masterclass", mappedBy="discipline")
     */
    private $masterClasses;

    public function __construct()
    {
        $this->masterClasses = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getMasterClasses(): ArrayCollection
    {
        return $this->masterClasses;
    }

    /**
     * @param ArrayCollection $masterClasses
     * @return Discipline
     */
    public function setMasterClasses(ArrayCollection $masterClasses): Discipline
    {
        $this->masterClasses = $masterClasses;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }
}
