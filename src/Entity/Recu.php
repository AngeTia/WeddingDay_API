<?php

namespace App\Entity;

use App\Repository\RecuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecuRepository::class)]
class Recu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'recu', targetEntity: Mairie::class)]
    private Collection $Mairie;

    #[ORM\OneToMany(mappedBy: 'recu', targetEntity: Reservation::class)]
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
            $mairie->setRecu($this);
        }

        return $this;
    }

    public function removeMairie(Mairie $mairie): self
    {
        if ($this->Mairie->removeElement($mairie)) {
            // set the owning side to null (unless already changed)
            if ($mairie->getRecu() === $this) {
                $mairie->setRecu(null);
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
            $reservation->setRecu($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->Reservation->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getRecu() === $this) {
                $reservation->setRecu(null);
            }
        }

        return $this;
    }
}
