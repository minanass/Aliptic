<?php

namespace App\Controller;

use App\Repository\RankingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RankingController extends AbstractController
{
    /**
     * @Route("/ranking", name="ranking")
     */
    public function index(RankingRepository $rankingRepo): Response
    {
        return $this->render('ranking/ranking.html.twig', [
            'controller_name' => 'RankingController',
            'ranking' => $rankingRepo->findAllUserOderByScore()
        ]);
    }
}
