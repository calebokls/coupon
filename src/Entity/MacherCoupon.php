<?php

namespace App\Entity;

use App\Repository\MacherCouponRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MacherCouponRepository::class)]
class MacherCoupon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column]
    private ?float $cote = null;

    #[ORM\OneToOne(inversedBy: 'macherCoupon', cascade: ['persist', 'remove'])]
    private ?BookMaker $book = null;

    #[ORM\Column(type: Types::DATE_MUTABLE,options: ['default','CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE,options: ['default','CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(type: Types::TIME_MUTABLE,options: ['default','CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $heurs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCote(): ?float
    {
        return $this->cote;
    }

    public function setCote(float $cote): self
    {
        $this->cote = $cote;

        return $this;
    }

    public function getBook(): ?BookMaker
    {
        return $this->book;
    }

    public function setBook(?BookMaker $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getHeurs(): ?\DateTimeInterface
    {
        return $this->heurs;
    }

    public function setHeurs(\DateTimeInterface $heurs): self
    {
        $this->heurs = $heurs;

        return $this;
    }
}
