<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GridRepository;
use App\Repository\GameRepository;
use App\Service\AnswerFormator;
use App\Service\DataFormator;
use App\Service\GridChecker;
use App\Service\LevelUp;
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
     * @Route("/game/{grid_id}", defaults={"grid_id"=null}, name="game", methods={"GET"})
    */
    public function index($grid_id): Response
    {
  
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->security->getUser();

        $gameNotResolved = $this->gameRepository->findGameNotResolved($user);
        
        if($grid_id){

            $entityManager = $this->getDoctrine()->getManager();

            $grid = $this->gridRepository->find($grid_id);
            if($gameNotResolved){
                $game = $gameNotResolved->setGrid($grid);
                $grid = $gameNotResolved->getGrid(); 
                $entityManager->persist($game);
            
            }else{           
                $game = (new Game())
                    ->setUser($user)
                    ->setGrid($grid)
                    ->setStartTime(new \DateTime('NOW'))
                    ->setEndTime()
                    ->setResult(0)
                    ->setNumberOfTests(0);
                $entityManager->persist($game);
            }

            $entityManager->flush();

        }else{

            if($gameNotResolved){
                $grid = $gameNotResolved->getGrid();
            }else{
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
    public function showGrids(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->security->getUser();

        $grids = $this->gridRepository->findGridsByUserLevel($user->getLevel());
    
        return $this->render('grids/grids.html.twig', [
            'grids' => $grids,
        ]);
    }

    /**
     * @Route("/check_answer", name="check_answer", methods={"POST"})
     */
    public function checkAnswer(Request $request): Response
    {

        //$submittedToken = $request->request->get('token');
      
        $data = $request->request->all();
        $submittedToken = array_shift($data);

        //Variables pour la monté de niveaux
        $user = $this->security->getUser();
        $entityManager = $this->getDoctrine()->getManager();

        
        if ($this->isCsrfTokenValid('check-answer', $submittedToken)) {
          
            $grid_id = array_pop($data);
            $answer = $data;
            $solution = $this->gridRepository->find($grid_id)->getSolution();
            $result = GridChecker::checkerAnswer($answer,  $solution );
            if($result){
                //Level Up enregistré dans la base de donné
                /**$level = $user->getLevel();
                if ($level == 1) {
                    $user->setLevel(2);
                }
                elseif ($level == 2) {
                    $user->setLevel(3);
                } **/
                LevelUp::checkLevel($user);
                $entityManager->flush();

                $this->addFlash('correctAnswer',"Félicitation tu as résolu ce sudoku, tu passes au niveau suivant" );
                return $this->redirectToRoute('grids');
            }else{
                $this->addFlash('wrongAnswer',"Malheureusement ta proposition n'est pas correcte, tu peux recommencer" );
                return $this->redirectToRoute('game');
            }
        }
        return $this->redirectToRoute('game');
    }
}
