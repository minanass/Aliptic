<?php

namespace App\Controller;

use App\Repository\GridRepository;
use App\Repository\GameRepository;
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
    private $gameRepository;
    private $security;


    public function __construct(GridRepository $gridRepository, Security $security , GameRepository $gameRepository){
        $this->gridRepository = $gridRepository;
        $this->gameRepository = $gameRepository;
        $this->security = $security;
      
    }

    /**
     * @Route("/game", name="game", methods={"GET"})
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->security->getUser();
        
        $gameNotResolved = $this->gameRepository->findGameNotResolved($user);

        if($gameNotResolved){
            $grid = $gameNotResolved->getGrid()->getInitialStructure();
        }else{
            return $this->redirectToRoute('grids');
        }

        return $this->render('game/game.html.twig', [
            'grid' => $grid,
        ]);
    }

    /**
     * @Route("/grids", name="grids", methods={"GET"})
     */
    public function showGrids(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->security->getUser();

        $grids = [];
        $a_entities_grid = $this->gridRepository->findGridsByUserLevel($user->getLevel());
        foreach($a_entities_grid as $entity_grid){
            $grid_structure = $entity_grid->getInitialStructure();
            array_push($grids, $grid_structure);
        }
    
        return $this->render('grids/grids.html.twig', [
            'grids' => $grids,
        ]);
    }

    /**
     * @Route("/check_answer", name="check_answer", methods={"POST"})
     */
    public function checkAnswer(Request $request): Response
    {
        $submittedToken = $request->request->get('token');

        if ($this->isCsrfTokenValid('check-answer', $submittedToken)) {
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
}
