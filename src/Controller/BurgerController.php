<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Entity\Oignon;
use App\Entity\Pain;
use App\Entity\Sauce;
use App\Form\BurgerType;
use App\Repository\BurgerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BurgerController extends AbstractController
{
    #[Route('/burgers', name: 'burger_index')]
    public function index(BurgerRepository $burgerRepository): Response
    {
        $burgers = $burgerRepository->findAll();

        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
        ]);
    }

    #[Route('/burger/{id}', name: 'burger_show', requirements: ['id' => '\d+'])]
    public function show(int $id, BurgerRepository $burgerRepository): Response
    {
        $burger = $burgerRepository->findBurgerWithDetails($id);

        if (!$burger) {
            throw $this->createNotFoundException('The burger does not exist');
        }

        return $this->render('burger/show.html.twig', ['burger' => $burger]);
    }

    #[Route('/burger/create', name: 'burger_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $burger = new Burger();
        $form = $this->createForm(BurgerType::class, $burger);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($burger);
            $entityManager->flush();

            return $this->redirectToRoute('burger_index');
        }

        return $this->render('burger/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/burgers/ingredient/{type}/{name}', name: 'burger_by_ingredient')]
    public function burgersByIngredient(BurgerRepository $burgerRepository, string $type, string $name): Response
    {
        $burgers = $burgerRepository->findBurgersWithIngredient($name, $type);

        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
            'ingredient' => $name,
        ]);
    }

    #[Route('/burgers/top/{limit}', name: 'burger_top_x')]
    public function topXBurgers(BurgerRepository $burgerRepository, int $limit): Response
    {
        $burgers = $burgerRepository->findTopXBurgers($limit);

        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
            'limit' => $limit,
        ]);
    }

    #[Route('/burgers/without-ingredient/{type}/{name}', name: 'burger_without_ingredient')]
    public function burgersWithoutIngredient(
        BurgerRepository $burgerRepository,
        EntityManagerInterface $entityManager,
        string $type,
        string $name
    ): Response {
        $ingredient = null;
        $repository = null;

        switch ($type) {
            case 'oignon':
                $repository = $entityManager->getRepository(Oignon::class);
                break;
            case 'sauce':
                $repository = $entityManager->getRepository(Sauce::class);
                break;
            case 'pain':
                $repository = $entityManager->getRepository(Pain::class);
                break;
            default:
                return $this->render('burger/index.html.twig', [
                    'burgers' => [],
                    'error' => "Type d'ingrédient non valide.",
                ]);
        }

        if ($repository) {
            $ingredient = $repository->findOneBy(['name' => $name]);
        }

        if (!$ingredient) {
            return $this->render('burger/index.html.twig', [
                'burgers' => [],
                'error' => "Ingrédient non trouvé.",
            ]);
        }

        $burgers = $burgerRepository->findBurgersWithoutIngredient($ingredient);

        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
            'ingredient_without' => $name,
        ]);
    }

    #[Route('/burgers/min-ingredients/{count}', name: 'burger_min_ingredients', requirements: ['count' => '\d+'])]
    public function burgersWithMinimumIngredients(BurgerRepository $burgerRepository, int $count): Response
    {
        $burgers = $burgerRepository->findBurgersWithMinimumIngredients($count);

        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
            'min_ingredients' => $count,
        ]);
    }
}
