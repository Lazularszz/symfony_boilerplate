<?php

namespace App\DataFixtures;

use App\Entity\Fromage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FromageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fromages = [
            'Cheddar',
            'Emmental',
            'Reblochon',
            'Comté',
            'Chèvre',
        ];

        foreach ($fromages as $fromageName) {
            $fromage = new Fromage();
            $fromage->setName($fromageName);
            $manager->persist($fromage);
        }

        $manager->flush();
    }
}
