<?php

namespace App\Controller;

use App\Repository\GridRepository;
use App\Service\AnswerFormator;
use App\Service\DataFormator;
use App\Service\GridChecker;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class GameController extends AbstractController
{
    private $gridRepository;
    private $security;


    public function __construct(GridRepository $gridRepository, Security $security){
        $this->gridRepository = $gridRepository;
        $this->security = $security;
    }
    /**
     * @Route("/game", name="game", methods={"GET"})
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_User');
        // TO-DO recupérer le current user + ajouter de vérification de connection
        $user = $this->security->getUser();

        // TO-DO modification du systeme de recupération de grid
        $lastGrid = $this->gridRepository->findOneBy([], ['id' => 'desc']);
        $lastId = $lastGrid->getId();
        $grid = $this->gridRepository->find($lastId);

        $grid_structure = $grid->getInitialStructure();

        return $this->render('game/game.html.twig', [
            'grid' => $grid_structure,
        ]);
    }

    /**
     * @Route("/check_answer", name="check_answer", methods={"POST"})
     */
    public function checkAnswer(Request $request): Response
    {
        $lastGrid = $this->gridRepository->findOneBy([], ['id' => 'desc']);
        $lastId = $lastGrid->getId();
        $grid = $this->gridRepository->find($lastId);
        $solution_structured = $grid->getSolution();

        $data = $request->request->all();
        $answer_strutured = GridChecker::structuredData($data);
        $answer = GridChecker::changeFormat($answer_strutured);
        $solution = GridChecker::changeFormat($solution_structured);
        $result = GridChecker::checkerAnswer($answer,  $solution );
        dd($result);
    }
}
