<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_epoux = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom_epoux = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_epouse = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom_epouse = null;

    #[ORM\Column(length: 255)]
    private ?string $contact = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_reservation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_mariage = null;

    #[ORM\Column(nullable: true)]
    private ?string $filename = null;

    #[ORM\Column(nullable: true)]
    private ?string $path = null;

    #[ORM\Column(nullable: true)]
    private ?string $originalFilename = null;

    private ?File $file = null;

    #[ORM\Column]
    private ?bool $reservation_status = null;

    #[ORM\ManyToOne(inversedBy: 'Reservation')]
    private ?Mairie $mairie = null;

    // #[ORM\ManyToOne(inversedBy: 'Reservation')]
    // private ?Recu $recu = null;

    // #[ORM\ManyToOne(inversedBy: 'Reservation')]
    // private ?Paiement $paiement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEpoux(): ?string
    {
        return $this->nom_epoux;
    }

    public function setNomEpoux(string $nom_epoux): self
    {
        $this->nom_epoux = $nom_epoux;

        return $this;
    }

    public function getPrenomEpoux(): ?string
    {
        return $this->prenom_epoux;
    }

    public function setPrenomEpoux(string $prenom_epoux): self
    {
        $this->prenom_epoux = $prenom_epoux;

        return $this;
    }
    public function getNomEpouse(): ?string
    {
        return $this->nom_epouse;
    }

    public function setNomEpouse(string $nom_epouse): self
    {
        $this->nom_epouse = $nom_epouse;

        return $this;
    }

    public function getPrenomEpouse(): ?string
    {
        return $this->prenom_epouse;
    }

    public function setPrenomEpouse(string $prenom_epouse): self
    {
        $this->prenom_epouse = $prenom_epouse;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->date_reservation;
    }

    public function setDateReservation(\DateTimeInterface $date_reservation): self
    {
        $this->date_reservation = $date_reservation;

        return $this;
    }

    public function getDateMariage(): ?\DateTimeInterface
    {
        return $this->date_mariage;
    }

    public function setDateMariage(\DateTimeInterface $date_mariage): self
    {
        $this->date_mariage = $date_mariage;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getOriginalFilename(): ?string
    {
        return $this->originalFilename;
    }

    public function setOriginalFilename(?string $originalFilename): self
    {
        $this->originalFilename = $originalFilename;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;
        if ($file instanceof UploadedFile) {
            $this->setOriginalFilename($file->getClientOriginalName());
        }
        return $this;
    }

    public function isReservationStatus(): ?bool
    {
        return $this->reservation_status;
    }

    public function setReservationStatus(bool $reservation_status): self
    {
        $this->reservation_status = $reservation_status;

        return $this;
    }

    public function getMairie(): ?Mairie
    {
        return $this->mairie;
    }

    public function setMairie(?Mairie $mairie): self
    {
        $this->mairie = $mairie;

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