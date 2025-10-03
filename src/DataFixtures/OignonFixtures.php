<?php

namespace App\DataFixtures;

use App\Entity\Oignon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OignonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $oignonRouge = new Oignon();
        $oignonRouge->setName('Rouge');
        $manager->persist($oignonRouge);

        $oignonBlanc = new Oignon();
        $oignonBlanc->setName('Blanc');
        $manager->persist($oignonBlanc);

        $oignonFrit = new Oignon();
        $oignonFrit->setName('Frit');
        $manager->persist($oignonFrit);

        $manager->flush();
    }
}
