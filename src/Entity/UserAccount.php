<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserAccountRepository")
 */
class UserAccount implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $IsAdmin;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="userAccounts")
     */
    private $customer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UsersGroup", inversedBy="usersAvalable")
     */
    private $usersGroup;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Group", mappedBy="user")
     */
    private $groups;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getIsAdmin(): ?bool
    {
        return $this->IsAdmin;
    }

    public function setIsAdmin(bool $IsAdmin): self
    {
        $this->IsAdmin = $IsAdmin;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function eraseCredentials(){}
    
        public function getSalt(){}
            
        public function getRoles()
            {
                return ['ROLE_USER'];
            }

        public function getUsersGroup(): ?UsersGroup
        {
            return $this->usersGroup;
        }

        public function setUsersGroup(?UsersGroup $usersGroup): self
        {
            $this->usersGroup = $usersGroup;

            return $this;
        }

        /**
         * @return Collection|Group[]
         */
        public function getGroups(): Collection
        {
            return $this->groups;
        }

        public function addGroup(Group $group): self
        {
            if (!$this->groups->contains($group)) {
                $this->groups[] = $group;
                $group->setUser($this);
            }

            return $this;
        }

        public function removeGroup(Group $group): self
        {
            if ($this->groups->contains($group)) {
                $this->groups->removeElement($group);
                // set the owning side to null (unless already changed)
                if ($group->getUser() === $this) {
                    $group->setUser(null);
                }
            }

            return $this;
        }
}
