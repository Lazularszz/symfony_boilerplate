<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Entity\Pain;
use App\Repository\BurgerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BurgerController extends AbstractController
{
    #[Route('/burgers', name: 'burger_list')]
    public function list(BurgerRepository $burgerRepository): Response
    {
        $burgers = $burgerRepository->findAll();

        return $this->render('burgers.html.twig', [
            'burgers' => $burgers,
        ]);
    }

    #[Route('/burger/{id}', name: 'burger_show', requirements: ['id' => '\d+'])]
    public function show(Burger $burger): Response
    {
        return $this->render('burger/show.html.twig', ['burger' => $burger]);
    }

    #[Route('/burger/create', name: 'burger_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        // 1. Récupérer un type de pain depuis la base de données
        $painRepository = $entityManager->getRepository(Pain::class);
        $pain = $painRepository->findOneBy([]);

        // S'assurer qu'un pain existe avant de continuer
        if (!$pain) {
            return new Response("Erreur : Aucun type de pain n'a été trouvé. Veuillez en créer un via les fixtures ou l'administration.");
        }

        // 2. Créer le nouveau burger
        $burger = new Burger();
        $burger->setName('Krabby Patty');
        $burger->setPrice(4.99);
        $burger->setDescription('A delicious burger with a secret formula.');
        
        // 3. Assigner le pain au burger
        $burger->setPain($pain);

        // 4. Persister et flusher le nouveau burger
        $entityManager->persist($burger);
        $entityManager->flush();

        return new Response('Burger créé avec succès ! ID: '. $burger->getId());
    }
}
