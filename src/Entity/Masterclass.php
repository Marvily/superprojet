<?php

namespace App\Entity;

use App\Repository\MasterclassRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MasterclassRepository::class)
 */
class Masterclass
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
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heuredebut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heurefin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $webcam;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="professorMasterClasses")
     */
    private $professor;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="masterClasses")
     */
    private $students;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Discipline", inversedBy="masterClasses")
     */
    private $discipline;

    /**
     * @ORM\Column(type="string")
     */
    private $status;


    private $classe;

    /**
     * @ORM\OneToMany(targetEntity=ConnectStudent::class, mappedBy="masterclass", orphanRemoval=true)
     */
    private $connectStudents;

    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param mixed $classe
     * @return Masterclass
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        if (null !== $classe) {
            $this->setStudents($classe->getUsers());
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function __construct()
    {
        $this->students= new ArrayCollection();
        $this->connectStudents = new ArrayCollection();
        $this->date= new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getDiscipline()
    {
        return $this->discipline;
    }

    /**
     * @param mixed $discipline
     * @return Masterclass
     */
    public function setDiscipline($discipline)
    {
        $this->discipline = $discipline;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeuredebut(): ?\DateTimeInterface
    {
        return $this->heuredebut;
    }

    public function setHeuredebut(\DateTimeInterface $heuredebut): self
    {
        $this->heuredebut = $heuredebut;

        return $this;
    }

    public function getHeurefin(): ?\DateTimeInterface
    {
        return $this->heurefin;
    }

    public function setHeurefin(\DateTimeInterface $heurefin): self
    {
        $this->heurefin = $heurefin;

        return $this;
    }

    public function getWebcam(): ?bool
    {
        return $this->webcam;
    }

    public function setWebcam(bool $webcam): self
    {
        $this->webcam = $webcam;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProfessor()
    {
        return $this->professor;
    }

    /**
     * @param mixed $professor
     * @return Masterclass
     */
    public function setProfessor($professor)
    {
        $this->professor = $professor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param mixed $students
     * @return Masterclass
     */
    public function setStudents($students)
    {
        $this->students = $students;
        return $this;
    }

    /**
     * @return Collection|ConnectStudent[]
     */
    public function getConnectStudents(): Collection
    {
        return $this->connectStudents;
    }

    public function addConnectStudent(ConnectStudent $connectStudent): self
    {
        if (!$this->connectStudents->contains($connectStudent)) {
            $this->connectStudents[] = $connectStudent;
            $connectStudent->setMasterclass($this);
        }

        return $this;
    }

    public function removeConnectStudent(ConnectStudent $connectStudent): self
    {
        if ($this->connectStudents->removeElement($connectStudent)) {
            // set the owning side to null (unless already changed)
            if ($connectStudent->getMasterclass() === $this) {
                $connectStudent->setMasterclass(null);
            }
        }

        return $this;
    }
}
