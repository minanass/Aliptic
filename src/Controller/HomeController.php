<?php

namespace App\Controller;

use App\Repository\GridRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
//    public function __construct(GridRepository $gridRepository){
//        $this->gridRepository = $gridRepository;
//    }
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
//
//        $lastGrid  = $this->gridRepository->findOneBy([], ['id' => 'desc']);
//        $lastId = $lastGrid->getId();
//        $gridFinded = $this->gridRepository->find($lastId);
//        $grid = $gridFinded->getInitialStructure();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
//            'grid' => $grid
        ]);
    }

    /**
     * @Route(path="/legales_mentions", name="legales_mentions")
     * @return Response
     */
    public function showLegalesMention(): Response
    {
        return $this->render('pages/legales_mentions.html.twig');
    }

}
