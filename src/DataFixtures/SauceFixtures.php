<?php

namespace App\DataFixtures;

use App\Entity\Sauce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SauceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ketchup = new Sauce();
        $ketchup->setName('Ketchup');
        $manager->persist($ketchup);

        $mayonnaise = new Sauce();
        $mayonnaise->setName('Mayonnaise');
        $manager->persist($mayonnaise);

        $moutarde = new Sauce();
        $moutarde->setName('Moutarde');
        $manager->persist($moutarde);

        $manager->flush();
    }
}
