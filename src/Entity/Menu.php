<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 */
class Menu
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
    private $MenuName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SubMenu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenuName(): ?string
    {
        return $this->MenuName;
    }

    public function setMenuName(string $MenuName): self
    {
        $this->MenuName = $MenuName;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getSubMenu(): ?string
    {
        return $this->SubMenu;
    }

    public function setSubMenu(string $SubMenu): self
    {
        $this->SubMenu = $SubMenu;

        return $this;
    }
}
