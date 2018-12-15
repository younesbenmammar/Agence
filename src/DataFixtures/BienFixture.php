<?php

namespace App\DataFixtures;

use App\Entity\Biens;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BienFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 100; $i++ ){
            $bien = New Biens();
            $bien
                ->setTitle($faker->words(3, true))
                ->setDescription($faker->sentences(3, true))
                ->setSurface($faker->numberBetween(20,350))
                ->setPieces($faker->numberBetween(2,10))
                ->setChambres($faker->numberBetween(1,7))
                ->setEtage($faker->numberBetween(0,15))
                ->setPrix($faker->numberBetween(200,99999))
                ->setChauffage($faker->numberBetween(0,2))
                ->setVille($faker->city)
                ->setCodePostale($faker->postcode)
                ->setDisponible(true);
            $manager->persist($bien);

        }
        $manager->flush();
    }
}
