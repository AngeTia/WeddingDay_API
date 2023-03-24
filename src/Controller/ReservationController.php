<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\MairieRepository;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ReservationController extends AbstractController
{
    #[Route('/api/reservations', name: 'allReservations', methods: ['GET'])]
    public function getAllReservation(ReservationRepository $ReservationsRepository, SerializerInterface $serializer): JsonResponse
    {
        $Reservations = $ReservationsRepository->findAll();
        
        $ReservationsJson = $serializer->serialize($Reservations, 'json');
        return new JsonResponse($ReservationsJson, Response::HTTP_OK, [], true);
    }

    // Route pour récupérer un Reservation par son id
    #[Route('/api/reservations/{id}', name: 'ReservationId', methods: ['GET'])]
    public function getDetailReservation(Reservation $Reservations, ReservationRepository $ReservationsRepository, SerializerInterface $serializer): JsonResponse
    {   
        $ReservationJson = $serializer->serialize($Reservations, 'json');
        return new JsonResponse($ReservationJson, Response::HTTP_OK, [], true);
    }

    // Route pour ajouter un Reservation
    #[Route('/api/reservations/create', name: 'addReservation', methods: ['POST'])]
    public function addReservation(MairieRepository $mairieRepository, Request $request, EntityManagerInterface $add, SerializerInterface $serializer): JsonResponse
    {
        $requestdata = json_decode($request->getContent(), true);
        $newReservation = new Reservation();
        $newReservation->setNomEpoux($requestdata['nomEpoux']);
        $newReservation->setPrenomEpoux($requestdata['prenomEpoux']);
        $newReservation->setNomEpouse($requestdata['nomEpouse']);
        $newReservation->setPrenomEpouse($requestdata['prenomEpouse']);
        $newReservation->setContact($requestdata['contact']);
        $newReservation->setDateReservation(new \DateTime());
        $newReservation->setDateMariage(new \DateTime($requestdata['dateMariage']));
        $newReservation->setReservationStatus($requestdata['reservationStatus']);

        $mairie = $mairieRepository->findOneBy(['id' => $requestdata['mairie']]);
        $newReservation->setMairie($mairie);

        $add->persist($newReservation);
        $add->flush();

        return $this->json([
            'code' => 200,
        ], 200, [], []
    );
    }
    
    // Route pour modifier un Reservation par son id
    #[Route('/api/reservations/update/{id}', name: 'updateReservation', methods: ['PUT'])]
    public function updateReservation(Reservation $Reservation, Request $request, EntityManagerInterface $update, SerializerInterface $serializer): JsonResponse
    {
        $Reservation = $serializer->deserialize($request->getContent(), Reservation::class, 'json', ['object_to_populate' => $Reservation]);
        $update->persist($Reservation);
        $update->flush();
    
        $jsonReservation = $serializer->serialize($Reservation, 'json');
        return new JsonResponse($jsonReservation, Response::HTTP_OK, [], true);
    }
    

    // Route pour supprimer un Reservation par son id
    #[Route('/api/reservations/delete/{id}', name: 'deleteReservation', methods: ['DELETE'])]
    public function deleteReservation(Reservation $Reservation, EntityManagerInterface $delete): JsonResponse
    {
        $delete->remove($Reservation);
        $delete->flush();
        return new JsonResponse('Reservation supprimé avec succès', Response::HTTP_OK);
    }
}
