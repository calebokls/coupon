<?php

namespace App\Entity;

use App\Repository\BookMakerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookMakerRepository::class)]
class BookMaker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'book', cascade: ['persist', 'remove'])]
    private ?MacherCoupon $macherCoupon = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

   public function __toString()
   {
    return $this->name;
   }

   public function getMacherCoupon(): ?MacherCoupon
   {
       return $this->macherCoupon;
   }

   public function setMacherCoupon(?MacherCoupon $macherCoupon): self
   {
       // unset the owning side of the relation if necessary
       if ($macherCoupon === null && $this->macherCoupon !== null) {
           $this->macherCoupon->setBook(null);
       }

       // set the owning side of the relation if necessary
       if ($macherCoupon !== null && $macherCoupon->getBook() !== $this) {
           $macherCoupon->setBook($this);
       }

       $this->macherCoupon = $macherCoupon;

       return $this;
   }
}
