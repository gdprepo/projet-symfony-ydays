<?php

namespace App\Entity;

use App\Repository\PronoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PronoRepository::class)
 */
class Prono
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
    private $Equip1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Equip2;

    /**
     * @ORM\Column(type="integer")
     */
    private $Confiance;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Ligue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Type;

    /**
     * @ORM\Column(type="array")
     */
    private $sub = [];

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEquip1(): ?string
    {
        return $this->Equip1;
    }

    public function setEquip1(string $Equip1): self
    {
        $this->Equip1 = $Equip1;

        return $this;
    }

    public function getEquip2(): ?string
    {
        return $this->Equip2;
    }

    public function setEquip2(string $Equip2): self
    {
        $this->Equip2 = $Equip2;

        return $this;
    }

    public function getConfiance(): ?int
    {
        return $this->Confiance;
    }

    public function setConfiance(int $Confiance): self
    {
        $this->Confiance = $Confiance;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getLigue(): ?string
    {
        return $this->Ligue;
    }

    public function setLigue(?string $Ligue): self
    {
        $this->Ligue = $Ligue;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getSub(): ?array
    {
        return $this->sub;
    }

    public function setSub(array $sub): self
    {
        $this->sub = $sub;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
