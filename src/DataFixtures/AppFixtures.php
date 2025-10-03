<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use App\Entity\Image;
use App\Entity\Pain;
use App\Entity\Oignon;
use App\Entity\Sauce;
use App\Entity\Fromage;
use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Récupérer les pains
        $painNormal = $manager->getRepository(Pain::class)->findOneBy(['name' => 'Normal']);
        $painBrioche = $manager->getRepository(Pain::class)->findOneBy(['name' => 'Brioché']);

        // Récupérer les oignons
        $oignonRouge = $manager->getRepository(Oignon::class)->findOneBy(['name' => 'Rouge']);
        $oignonBlanc = $manager->getRepository(Oignon::class)->findOneBy(['name' => 'Blanc']);
        $oignonFrit = $manager->getRepository(Oignon::class)->findOneBy(['name' => 'Frit']);

        // Récupérer les sauces
        $ketchup = $manager->getRepository(Sauce::class)->findOneBy(['name' => 'Ketchup']);
        $mayonnaise = $manager->getRepository(Sauce::class)->findOneBy(['name' => 'Mayonnaise']);
        $moutarde = $manager->getRepository(Sauce::class)->findOneBy(['name' => 'Moutarde']);

        // Récupérer les fromages
        $cheddar = $manager->getRepository(Fromage::class)->findOneBy(['name' => 'Cheddar']);

        // Images
        $cheeseburgerImage = (new Image())->setPath('img/cheeseburger.jpg');
        $manager->persist($cheeseburgerImage);

        $baconBurgerImage = (new Image())->setPath('img/bacon-burger.jpg');
        $manager->persist($baconBurgerImage);

        $veggieBurgerImage = (new Image())->setPath('img/veggie-burger.jpg');
        $manager->persist($veggieBurgerImage);

        $krabbyPattyImage = (new Image())->setPath('img/krabby-patty.jpg');
        $manager->persist($krabbyPattyImage);


        // Burgers
        $cheeseburger = new Burger();
        $cheeseburger->setName('Cheeseburger');
        $cheeseburger->setPrice(8.99);
        $cheeseburger->setDescription('Un classique américain avec son steak, son fromage fondant, ses cornichons et son ketchup.');
        $cheeseburger->setPain($painNormal);
        $cheeseburger->setImage($cheeseburgerImage);
        $cheeseburger->addOignon($oignonBlanc);
        $cheeseburger->addOignon($oignonFrit);
        $cheeseburger->addSauce($ketchup);
        $cheeseburger->addFromage($cheddar);
        $manager->persist($cheeseburger);

        $baconBurger = new Burger();
        $baconBurger->setName('Bacon Burger');
        $baconBurger->setPrice(11.99);
        $baconBurger->setDescription('Pour les amateurs de bacon, avec son steak juteux, son bacon croustillant et sa sauce barbecue.');
        $baconBurger->setPain($painBrioche);
        $baconBurger->setImage($baconBurgerImage);
        $baconBurger->addOignon($oignonFrit);
        $baconBurger->addSauce($mayonnaise);
        $manager->persist($baconBurger);
        
        $veggieBurger = new Burger();
        $veggieBurger->setName('Veggie Burger');
        $veggieBurger->setPrice(9.99);
        $veggieBurger->setDescription('Une option végétarienne délicieuse avec son steak de légumes, sa salade, ses tomates et sa sauce.');
        $veggieBurger->setPain($painBrioche);
        $veggieBurger->setImage($veggieBurgerImage);
        $veggieBurger->addOignon($oignonRouge);
        $veggieBurger->addSauce($moutarde);
        $manager->persist($veggieBurger);
        
        $krabbyPatty = new Burger();
        $krabbyPatty->setName('Krabby Patty');
        $krabbyPatty->setPrice(12.99);
        $krabbyPatty->setDescription('Le secret le mieux gardé de Bikini Bottom. Un délice sous-marin !');
        $krabbyPatty->setPain($painNormal);
        $krabbyPatty->setImage($krabbyPattyImage);
        $krabbyPatty->addOignon($oignonBlanc);
        $krabbyPatty->addSauce($ketchup);
        $manager->persist($krabbyPatty);

        // Commentaires
        $commentaire1 = new Commentaire();
        $commentaire1->setContent('Super burger !');
        $commentaire1->setBurger($cheeseburger);
        $manager->persist($commentaire1);

        $commentaire2 = new Commentaire();
        $commentaire2->setContent('Un peu sec, mais bon.');
        $commentaire2->setBurger($cheeseburger);
        $manager->persist($commentaire2);

        $commentaire3 = new Commentaire();
        $commentaire3->setContent('Le meilleur bacon burger que j\'ai jamais mangé !');
        $commentaire3->setBurger($baconBurger);
        $manager->persist($commentaire3);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PainFixtures::class,
            OignonFixtures::class,
            SauceFixtures::class,
            FromageFixtures::class,
        ];
    }
}
