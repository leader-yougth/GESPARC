<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer
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
    private $Customer_FirstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Customer_LastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Customer_Avatar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Customer_PositionHeld;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserAccount", mappedBy="customer")
     */
    private $userAccounts;

    public function __construct()
    {
        $this->userAccounts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerFirstName(): ?string
    {
        return $this->Customer_FirstName;
    }

    public function setCustomerFirstName(string $Customer_FirstName): self
    {
        $this->Customer_FirstName = $Customer_FirstName;

        return $this;
    }

    public function getCustomerLastName(): ?string
    {
        return $this->Customer_LastName;
    }

    public function setCustomerLastName(string $Customer_LastName): self
    {
        $this->Customer_LastName = $Customer_LastName;

        return $this;
    }

    public function getCustomerAvatar()
    {
        return $this->Customer_Avatar;
    }

    public function setCustomerAvatar($Customer_Avatar)
    {
        $this->Customer_Avatar = $Customer_Avatar;

        return $this;
    }

    public function getCustomerPositionHeld(): ?string
    {
        return $this->Customer_PositionHeld;
    }

    public function setCustomerPositionHeld(string $Customer_PositionHeld): self
    {
        $this->Customer_PositionHeld = $Customer_PositionHeld;

        return $this;
    }

    /**
     * @return Collection|UserAccount[]
     */
    public function getUserAccounts(): Collection
    {
        return $this->userAccounts;
    }

    public function addUserAccount(UserAccount $userAccount): self
    {
        if (!$this->userAccounts->contains($userAccount)) {
            $this->userAccounts[] = $userAccount;
            $userAccount->setCustomer($this);
        }

        return $this;
    }

    public function removeUserAccount(UserAccount $userAccount): self
    {
        if ($this->userAccounts->contains($userAccount)) {
            $this->userAccounts->removeElement($userAccount);
            // set the owning side to null (unless already changed)
            if ($userAccount->getCustomer() === $this) {
                $userAccount->setCustomer(null);
            }
        }

        return $this;
    }
}
