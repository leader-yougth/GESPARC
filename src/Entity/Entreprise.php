<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrepriseRepository")
 */
class Entreprise
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
    private $NomEntreprise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SecteurActivite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LogoEntreprise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $BoitePostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SiteWeb;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EmailEntreprise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PaysEntreprise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $VilleEntreprise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEntreprise(): ?string
    {
        return $this->NomEntreprise;
    }

    public function setNomEntreprise(string $NomEntreprise): self
    {
        $this->NomEntreprise = $NomEntreprise;

        return $this;
    }

    public function getSecteurActivite(): ?string
    {
        return $this->SecteurActivite;
    }

    public function setSecteurActivite(string $SecteurActivite): self
    {
        $this->SecteurActivite = $SecteurActivite;

        return $this;
    }

    public function getLogoEntreprise()
    {
        return $this->LogoEntreprise;
    }

    public function setLogoEntreprise($LogoEntreprise)
    {
        $this->LogoEntreprise = $LogoEntreprise;

        return $this;
    }

    public function getBoitePostal(): ?string
    {
        return $this->BoitePostal;
    }

    public function setBoitePostal(string $BoitePostal): self
    {
        $this->BoitePostal = $BoitePostal;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->SiteWeb;
    }

    public function setSiteWeb(string $SiteWeb): self
    {
        $this->SiteWeb = $SiteWeb;

        return $this;
    }

    public function getEmailEntreprise(): ?string
    {
        return $this->EmailEntreprise;
    }

    public function setEmailEntreprise(string $EmailEntreprise): self
    {
        $this->EmailEntreprise = $EmailEntreprise;

        return $this;
    }

    public function getPaysEntreprise(): ?string
    {
        return $this->PaysEntreprise;
    }

    public function setPaysEntreprise(string $PaysEntreprise): self
    {
        $this->PaysEntreprise = $PaysEntreprise;

        return $this;
    }

    public function getVilleEntreprise(): ?string
    {
        return $this->VilleEntreprise;
    }

    public function setVilleEntreprise(string $VilleEntreprise): self
    {
        $this->VilleEntreprise = $VilleEntreprise;

        return $this;
    }
}
