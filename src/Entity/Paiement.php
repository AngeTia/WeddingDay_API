<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'paiement', targetEntity: Mairie::class)]
    private Collection $Mairie;

    #[ORM\OneToMany(mappedBy: 'paiement', targetEntity: Reservation::class)]
    private Collection $Reservation;

    public function __construct()
    {
        $this->Mairie = new ArrayCollection();
        $this->Reservation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Mairie>
     */
    public function getMairie(): Collection
    {
        return $this->Mairie;
    }

    public function addMairie(Mairie $mairie): self
    {
        if (!$this->Mairie->contains($mairie)) {
            $this->Mairie->add($mairie);
            $mairie->setPaiement($this);
        }

        return $this;
    }

    public function removeMairie(Mairie $mairie): self
    {
        if ($this->Mairie->removeElement($mairie)) {
            // set the owning side to null (unless already changed)
            if ($mairie->getPaiement() === $this) {
                $mairie->setPaiement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservation(): Collection
    {
        return $this->Reservation;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->Reservation->contains($reservation)) {
            $this->Reservation->add($reservation);
            $reservation->setPaiement($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->Reservation->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getPaiement() === $this) {
                $reservation->setPaiement(null);
            }
        }

        return $this;
    }
}
