<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use App\Entity\Commentaire;
use App\Entity\Image;
use App\Entity\Oignon;
use App\Entity\Pain;
use App\Entity\Sauce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Pains
        $painBrioche = new Pain();
        $painBrioche->setName('Brioché');
        $manager->persist($painBrioche);

        $painNormal = new Pain();
        $painNormal->setName('Normal');
        $manager->persist($painNormal);

        // Oignons
        $oignonRouge = new Oignon();
        $oignonRouge->setName('Oignon rouge');
        $manager->persist($oignonRouge);

        $oignonCaramelise = new Oignon();
        $oignonCaramelise->setName('Oignon caramélisé');
        $manager->persist($oignonCaramelise);

        // Sauces
        $sauceKetchup = new Sauce();
        $sauceKetchup->setName('Ketchup');
        $manager->persist($sauceKetchup);

        $sauceBbq = new Sauce();
        $sauceBbq->setName('BBQ');
        $manager->persist($sauceBbq);

        // Images
        $cheeseburgerImage = new Image();
        $cheeseburgerImage->setPath('cheeseburger.jpg');
        $manager->persist($cheeseburgerImage);

        $baconBurgerImage = new Image();
        $baconBurgerImage->setPath('bacon-burger.jpg');
        $manager->persist($baconBurgerImage);

        $veggieBurgerImage = new Image();
        $veggieBurgerImage->setPath('veggie-burger.jpg');
        $manager->persist($veggieBurgerImage);

        // Burgers
        $cheeseburger = new Burger();
        $cheeseburger->setName('Cheeseburger');
        $cheeseburger->setPrice(8.99);
        $cheeseburger->setDescription('Un classique avec son steak haché, son fromage fondant, sa salade croquante et ses cornichons.');
        $cheeseburger->setPain($painNormal);
        $cheeseburger->addSauce($sauceKetchup);
        $cheeseburger->setImage($cheeseburgerImage);
        $manager->persist($cheeseburger);

        $baconBurger = new Burger();
        $baconBurger->setName('Bacon Burger');
        $baconBurger->setPrice(10.99);
        $baconBurger->setDescription('Pour les amateurs de bacon, avec son steak haché, son fromage, son bacon croustillant et sa sauce BBQ.');
        $baconBurger->setPain($painBrioche);
        $baconBurger->addOignon($oignonCaramelise);
        $baconBurger->addSauce($sauceBbq);
        $baconBurger->setImage($baconBurgerImage);
        $manager->persist($baconBurger);

        $veggieBurger = new Burger();
        $veggieBurger->setName('Veggie Burger');
        $veggieBurger->setPrice(9.99);
        $veggieBurger->setDescription('Une option végétarienne délicieuse avec son steak de légumes, sa salade, ses tomates et sa sauce.');
        $veggieBurger->setPain($painBrioche);
        $veggieBurger->setImage($veggieBurgerImage);
        $manager->persist($veggieBurger);

        // Commentaires
        $commentaire1 = new Commentaire();
        $commentaire1->setContent('Super bon ce burger !');
        $commentaire1->setBurger($cheeseburger);
        $manager->persist($commentaire1);

        $commentaire2 = new Commentaire();
        $commentaire2->setContent('Le bacon est incroyable !');
        $commentaire2->setBurger($baconBurger);
        $manager->persist($commentaire2);

        $manager->flush();
    }
}
