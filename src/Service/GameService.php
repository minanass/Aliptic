<?php 

namespace App\Service;

use App\Entity\Game;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;


class GameService{

    protected $security;
	protected $entityManager;

    public function __construct(Security $security, EntityManagerInterface $entityManager)
    {
		$this->security = $security;
		$this->entityManager = $entityManager;
    }

    public function createNewGame($grid)
    {
        $user = $this->security->getUser();
        $game = (new Game())
                    ->setUser($user)
                    ->setGrid($grid)
                    ->setStartTime(new \DateTime('NOW'))
                    ->setEndTime()
                    ->setResult(0)
                    ->setNumberOfTests(0);
        $this->entityManager->persist($game);
        $this->entityManager->flush();
    }

    public function changeGridOfGame($game)
    {
        $this->entityManager->persist($game);
        $this->entityManager->flush();
    }
}