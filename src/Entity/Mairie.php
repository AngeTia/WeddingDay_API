<?php

namespace App\Entity;

use App\Repository\MairieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MairieRepository::class)]
class Mairie
{
    #[Groups(['show_reservation'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['show_reservation'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['show_reservation'])]
    private ?string $addresse = null;

    #[ORM\Column(length: 20)]
    #[Groups(['show_reservation'])]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    #[Groups(['show_reservation'])]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'mairie', targetEntity: Planning::class)]
    private Collection $Planning;

    #[ORM\OneToMany(mappedBy: 'mairie', targetEntity: Reservation::class)]
    private Collection $Reservation;

    #[ORM\OneToMany(mappedBy: 'mairie', targetEntity: Utilisateur::class)]
    private Collection $Utilisateur;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['show_reservation'])]
    private ?string $picture = null;

    // #[ORM\ManyToOne(inversedBy: 'Mairie')]
    // private ?Recu $recu = null;

    // #[ORM\ManyToOne(inversedBy: 'Mairie')]
    // private ?Paiement $paiement = null;

    public function __construct()
    {
        $this->Planning = new ArrayCollection();
        $this->Reservation = new ArrayCollection();
        // $this->Utilisateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function setAddresse(string $addresse): self
    {
        $this->addresse = $addresse;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Planning>
     */
    public function getPlanning(): Collection
    {
        return $this->Planning;
    }

    public function addPlanning(Planning $planning): self
    {
        if (!$this->Planning->contains($planning)) {
            $this->Planning->add($planning);
            $planning->setMairie($this);
        }

        return $this;
    }

    public function removePlanning(Planning $planning): self
    {
        if ($this->Planning->removeElement($planning)) {
            // set the owning side to null (unless already changed)
            if ($planning->getMairie() === $this) {
                $planning->setMairie(null);
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
            $reservation->setMairie($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->Reservation->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getMairie() === $this) {
                $reservation->setMairie(null);
            }
        }

        return $this;
    }

    // /**
    //  * @return Collection<int, Utilisateur>
    //  */
    // public function getUsers(): Collection
    // {
    //     return $this->Utilisateur;
    // }

    // public function addUser(Utilisateur $user): self
    // {
    //     if (!$this->Utilisateur->contains($user)) {
    //         $this->Utilisateur->add($user);
    //         $user->setMairie($this);
    //     }

    //     return $this;
    // }

    // public function removeUser(Utilisateur $user): self
    // {
    //     if ($this->Utilisateur->removeElement($user)) {
    //         // set the owning side to null (unless already changed)
    //         if ($user->getMairie() === $this) {
    //             $user->setMairie(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    // public function getRecu(): ?Recu
    // {
    //     return $this->recu;
    // }

    // public function setRecu(?Recu $recu): self
    // {
    //     $this->recu = $recu;

    //     return $this;
    // }

    // public function getPaiement(): ?Paiement
    // {
    //     return $this->paiement;
    // }

    // public function setPaiement(?Paiement $paiement): self
    // {
    //     $this->paiement = $paiement;

    //     return $this;
    // }

}
