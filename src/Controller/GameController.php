<?php

namespace App\Controller;

use App\Repository\GridRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game", methods={"GET"})
     */
    public function index(GridRepository $gridRepository): Response
    {
        return $this->render('game/game.html.twig', [
            'grid' => $gridRepository->findAll(),
        ]);
    }
}
