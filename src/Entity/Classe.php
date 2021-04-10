<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 */
class Classe
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
    private $instituition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codepostal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="classe")
     */
    private $users;

    /**
     * @return ArrayCollection
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @param ArrayCollection $users
     * @return Classe
     */
    public function setUsers(ArrayCollection $users): Classe
    {
        $this->users = $users;
        return $this;
    }

    public function __construct()
    {
        $this->users=new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInstituition(): ?string
    {
        return $this->instituition;
    }

    public function setInstituition(string $instituition): self
    {
        $this->instituition = $instituition;

        return $this;
    }

    public function getCodepostal(): ?string
    {
        return $this->codepostal;
    }

    public function setCodepostal(string $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }
}
