<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Annonce;


class AnnonceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $product = new Annonce();

            $product->setTitre("Annonce ".$i);
            $product->setContenu("Le contenu de l'annonce ".$i);
            $product->setPrix(mt_rand(10, 100));
            $product->setCodePostal(63000);
            $product->setDateCreation(new \DateTime());
            $manager->persist($product);
        }
        $manager->flush();
    }
}
