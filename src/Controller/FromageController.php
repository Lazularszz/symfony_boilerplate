<?php

namespace App\Controller;

use App\Repository\FromageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FromageController extends AbstractController
{
    #[Route('/fromages', name: 'fromage_index')]
    public function index(FromageRepository $fromageRepository): Response
    {
        $fromages = $fromageRepository->findAll();

        return $this->render('fromage/index.html.twig', [
            'fromages' => $fromages,
        ]);
    }
}
