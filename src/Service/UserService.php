<?php
namespace App\Service;

use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;


class UserService {


	protected $security;
	protected $entityManager;

    public function __construct(Security $security, EntityManagerInterface $entityManager)
    {
		$this->security = $security;
		$this->entityManager = $entityManager;
    }

	public function increaseLevelAndScore() : void
	{
		$user = $this->security->getUser();

		$this->increaseLevel($user);
		$this->increaseScore($user);
	}

	protected function increaseLevel($user) : void
	{
	
		$level = $user->getLevel();

		if ($level != 3)
		{
			$user->setLevel(++$level);
			$this->entityManager->persist($user);
			$this->entityManager->flush();
		}
	}

	protected function increaseScore($user) : void
	{
		
		$score = $user->getScore();

		if ($score != 12)
		{
			$user->setScore($score += 4);
			$this->entityManager->persist($user);
			$this->entityManager->flush();
		}
	}

}

