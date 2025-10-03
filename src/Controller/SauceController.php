<?php

namespace App\Controller;

use App\Entity\Sauce;
use App\Repository\SauceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SauceController extends AbstractController
{
    #[Route('/sauces', name: 'sauce_index')]
    public function index(SauceRepository $sauceRepository): Response
    {
        $sauces = $sauceRepository->findAll();

        return $this->render('sauce/index.html.twig', [
            'sauces' => $sauces,
        ]);
    }

    #[Route('/sauce/create', name: 'sauce_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $sauce = new Sauce();
        $sauce->setName('Ketchup');

        $entityManager->persist($sauce);
        $entityManager->flush();

        return new Response('Sauce créée avec succès !');
    }
}
