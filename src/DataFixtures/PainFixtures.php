<?php

namespace App\DataFixtures;

use App\Entity\Pain;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PainFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $painNormal = new Pain();
        $painNormal->setName('Normal');
        $manager->persist($painNormal);

        $painBrioche = new Pain();
        $painBrioche->setName('Brioché');
        $manager->persist($painBrioche);

        $manager->flush();
    }
}
