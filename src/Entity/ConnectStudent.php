<?php

namespace App\Entity;

use App\Repository\ConnectStudentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConnectStudentRepository::class)
 */
class ConnectStudent
{

    /**
     * @ORM\Column(type="time")
     */
    private $debutconnexion;

    /**
     * @ORM\Column(type="time")
     */
    private $finconnexion;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="connectStudents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    /**
     * 0@ORM\Id
     * @ORM\ManyToOne(targetEntity=Masterclass::class, inversedBy="connectStudents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $masterclass;



    public function getDebutconnexion(): ?\DateTimeInterface
    {
        return $this->debutconnexion;
    }

    public function setDebutconnexion(\DateTimeInterface $debutconnexion): self
    {
        $this->debutconnexion = $debutconnexion;

        return $this;
    }

    public function getFinconnexion(): ?\DateTimeInterface
    {
        return $this->finconnexion;
    }

    public function setFinconnexion(\DateTimeInterface $finconnexion): self
    {
        $this->finconnexion = $finconnexion;

        return $this;
    }

    public function getStudent(): ?User
    {
        return $this->student;
    }

    public function setStudent(?User $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getMasterclass(): ?Masterclass
    {
        return $this->masterclass;
    }

    public function setMasterclass(?Masterclass $masterclass): self
    {
        $this->masterclass = $masterclass;

        return $this;
    }
}
