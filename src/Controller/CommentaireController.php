<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Entity\Commentaire;
use App\Repository\CommentaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CommentaireController extends AbstractController
{
    #[Route('/commentaires', name: 'commentaire_index')]
    public function index(CommentaireRepository $commentaireRepository): Response
    {
        $commentaires = $commentaireRepository->findAll();

        return $this->render('commentaire/index.html.twig', [
            'commentaires' => $commentaires,
        ]);
    }

    #[Route('/commentaire/create', name: 'commentaire_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $commentaire = new Commentaire();
        $commentaire->setContent('Super burger !');

        $burger = $entityManager->getRepository(Burger::class)->find(1); // Assuming a burger with id 1 exists
        $commentaire->setBurger($burger);

        $entityManager->persist($commentaire);
        $entityManager->flush();

        return new Response('Commentaire créé avec succès !');
    }
}
