<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GridRepository;
use App\Repository\GameRepository;
use App\Service\GridChecker;
use App\Service\UserService;
use App\Service\GameService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


class GameController extends AbstractController
{
    private $gridRepository;
    private $gameRepository;
    private $user;
    private $userService;
    private $gameService;


    public function __construct(GridRepository  $gridRepository,
                                Security        $security,
                                GameRepository  $gameRepository,
                                UserService     $userService,
                                GameService     $gameService)
    {
        $this->gridRepository = $gridRepository;
        $this->gameRepository = $gameRepository;
        $this->user           = $security->getUser();
        $this->userService    = $userService;
        $this->gameService    = $gameService;
    }

    /**
     * @Route("/game/{grid_id}", defaults={"grid_id"=null}, name="game", methods={"GET"}) 
     */
    public function showGame($grid_id) : Response
    {
  
        $gameNotResolved = $this->gameRepository->findGameNotResolved($this->user);
        
        if(!is_null($grid_id))
        {
            $grid = $this->gridRepository->find($grid_id);

            if($gameNotResolved)
            {
                $game = $gameNotResolved->setGrid($grid);
                $this->gameService->changeGridOfGame($game);
            }
            else
            {           
                $this->gameService->createNewGame($grid);
            }

        }
        else
        {

            if($gameNotResolved)
            {
                $grid = $gameNotResolved->getGrid();
            }
            else
            {
                return $this->redirectToRoute('grids');
            }
        }
     
        return $this->render('game/game.html.twig', [
            'grid' => $grid,
        ]);
    }

    /**
     * @Route("/grids", name="grids", methods={"GET"})
    */
    public function showGrids() : Response
    {
        $user_level     = $this->user->getLevel();
        $grids          = $this->gridRepository->findGridsByUserLevel($user_level);
    
        return $this->render('grids/grids.html.twig', [
            'grids' => $grids,
        ]);
    }

    /**
     * @Route("/check_answer", name="check_answer", methods={"POST"})
     */
    public function checkAnswer(Request $request): Response
    {
        $data           = $request->request->all();
        $submittedToken = array_shift($data);

        if ($this->isCsrfTokenValid('check-answer', $submittedToken)) 
        {
          
            $grid_id    = array_pop($data);
            $answer     = $data;
            $solution   = $this->gridRepository->find($grid_id)->getSolution();
            $result     = GridChecker::checkerAnswer($answer,  $solution );

            if($result)
            {
                $this->userService->increaseLevelAndScore();
                $this->addFlash('correctAnswer',"Félicitation tu as résolu ce sudoku, tu passes au niveau suivant" );
                return $this->redirectToRoute('grids');
            }
            else
            {
                $this->addFlash('wrongAnswer',"Malheureusement ta proposition n'est pas correcte, tu peux recommencer" );
                return $this->redirectToRoute('game');
            }
        }
        return $this->redirectToRoute('game');
    }
}
