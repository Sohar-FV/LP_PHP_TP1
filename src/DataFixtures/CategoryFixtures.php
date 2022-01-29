<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Annonce;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category = new Category();
        $category->setName("Global");
        $category->setColor("#ffffff");
        $manager->persist($category);
        $manager->flush();

        for ($i = 0; $i < 5; $i++) {
            $annonce = new Annonce();

            $annonce->setTitre("Annonce ".$i);
            $annonce->setCategory($category);
            $annonce->setContenu("Le contenu de l'annonce ".$i);
            $annonce->setPrix(mt_rand(10, 100));
            $annonce->setCodePostal(63000);
            $annonce->setDateCreation(new \DateTime());
            $manager->persist($annonce);
        }

        $manager->flush();
    }
}
