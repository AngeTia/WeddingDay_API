<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UtilisateurController extends AbstractController
{

    private $userRepo;
    private $passwordHasher;
    private $repoCritere;
    public function __construct(
        UserPasswordHasherInterface $passwordHasher, 
        UtilisateurRepository $userRepo) {
        $this->passwordHasher = $passwordHasher;
        $this->userRepo = $userRepo;
    }

    // Route pour créer un User
    #[Route('/api/users/create', name: 'createUser', methods: ["POST"])]
    public function index(Request $request): JsonResponse
    {

        // $this->denyAccessUnlessGranted('ROLE_COMMENT_ADMIN');

        // get data request
        $request_data = json_decode($request->getContent(), true);

        // save user and check if username exist
        $user = new Utilisateur();
        
        $verifUsername = $this->userRepo->findOneByUsername($request_data["email"]);
        if ($verifUsername != null) {
            return new JsonResponse("Ce username d'utilisateur est déjà utilisé.", Response::HTTP_UNAUTHORIZED, [], true);
        }

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $this->passwordHasher->hashPassword($user, $request_data["password"]);
        $user->setPassword($hashedPassword);
        $user->setUsername($request_data["email"]);
        $user->setNom($request_data["nom"]);
        $user->setPrenom($request_data["prenom"]);
        $user->setEmail($request_data["email"]);
        $user->setRoles(array('ROLE_PUBLISHER') );

        // save user
        $this->userRepo->save($user, true);

        return new JsonResponse('Operation effectuee avec succes', Response::HTTP_OK, [], true);

    }

    // Route pour récupérer tous les Users
    #[Route('/api/users', name: 'allUsers', methods: ['GET'])]
    public function getAllUser(UtilisateurRepository $usersRepository, SerializerInterface $serializer): JsonResponse
    {
        $users = $usersRepository->findAll();
        
        $usersJson = $serializer->serialize($users, 'json');
        return new JsonResponse($usersJson, Response::HTTP_OK, [], true);
    }
}