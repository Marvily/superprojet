<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Masterclass", mappedBy="professor")
     */
    private $professorMasterClasses;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Masterclass", mappedBy="students")
     */
    private $masterClasses;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe", inversedBy="users")
     */
    private $classe;

    private $plainPassword;

    /**
     * @ORM\OneToMany(targetEntity=ConnectStudent::class, mappedBy="student", orphanRemoval=true)
     */
    private $connectStudents;

    public function __construct()
    {
        $this->professorMasterClasses= new ArrayCollection();
        $this->masterClasses= new ArrayCollection();
        $this->connectStudents = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param mixed $classe
     * @return User
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProfessorMasterClasses()
    {
        return $this->professorMasterClasses;
    }

    /**
     * @param mixed $professorMasterClasses
     * @return User
     */
    public function setProfessorMasterClasses($professorMasterClasses)
    {
        $this->professorMasterClasses = $professorMasterClasses;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMasterClasses()
    {
        return $this->masterClasses;
    }

    /**
     * @param mixed $masterClasses
     * @return User
     */
    public function setMasterClasses($masterClasses)
    {
        $this->masterClasses = $masterClasses;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
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
            $connectStudent->setStudent($this);
        }

        return $this;
    }

    public function removeConnectStudent(ConnectStudent $connectStudent): self
    {
        if ($this->connectStudents->removeElement($connectStudent)) {
            // set the owning side to null (unless already changed)
            if ($connectStudent->getStudent() === $this) {
                $connectStudent->setStudent(null);
            }
        }

        return $this;
    }
}
