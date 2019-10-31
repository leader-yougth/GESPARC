<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersGroupRepository")
 */
class UsersGroup
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
    private $GroupName;

    /**
     * @ORM\Column(type="array")
     */
    private $AvaibleUsers = [];

    /**
     * @ORM\Column(type="array")
     */
    private $role = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroupName(): ?string
    {
        return $this->GroupName;
    }

    public function setGroupName(string $GroupName): self
    {
        $this->GroupName = $GroupName;

        return $this;
    }

    public function getAvaibleUsers(): ?array
    {
        return $this->AvaibleUsers;
    }

    public function setAvaibleUsers(array $AvaibleUsers): self
    {
        $this->AvaibleUsers = $AvaibleUsers;

        return $this;
    }

    public function getRole(): ?array
    {
        return $this->role;
    }

    public function setRole(array $role): self
    {
        $this->role = $role;

        return $this;
    }
}
