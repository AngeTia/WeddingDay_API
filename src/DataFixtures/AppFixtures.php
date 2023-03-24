<?php

namespace App\DataFixtures;

use App\Entity\Mairie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {        
        // Création d'une vingtaine de mairie
        for ($i = 0; $i < 20; $i++) {
             // A se niveau, on peut utiliser les setters pour pourvoir leur donner des données aléatoires
            $mairie = new Mairie;
            $mairie->setNom('Mairie de ' . $i);
            $mairie->setAddresse('Addresse de ' . $i);
            $mairie->setPhone('Phone de ' . $i);
            $mairie->setEmail('Email de ' . $i);
            $$mairie->setPicture('Picture de ' . $i);
            $manager->persist($mairie);
        }

        // // On enregistre les données en base de données pour le planning
        // for ($i = 0; $i < 20; $i++) {
        //     $planning = new Planning;
        //     $planning->setReservationNumber(1 . $i);
        //     $planning->setDay('Prenom de ' . $i);
        //     $manager->persist($planning);
        // }
        $manager->flush();
    }
}
