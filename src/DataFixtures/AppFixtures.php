<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\Grid;
use App\Entity\Ranking;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('Mario');
        $password = $this->encoder->encodePassword($user, '123456');
        $user->setPassword($password);
        $user->setEmail('mario@mushroom.com');
        $user->setRoles(['ROLE_User']);
        $user->setScore(4);
        $user->setLevel(1);
        $manager->persist($user);

        $grid = (new Grid())
            -> setName('Grid_1')
            -> setLevel('1')
            -> setInitialStructure($this->level_1_Structure)
            -> setSolution($this->level_1_Solution);
        $manager->persist($grid);

        $game = (new Game())
            ->setUser($user)
            ->setGrid($grid)
            ->setStartTime(new \DateTime('NOW'))
            ->setEndTime()
            ->setResult(0)
            ->setNumberOfTests(0);
        $manager->persist($game);

        $ranking = (new Ranking())
            ->setName("Classement général");
        $manager->persist($ranking);

        $manager->flush();
    }

    public function creationSolution(){
        $solution =[];
        for($indexRow = 0;$indexRow <= 8; $indexRow++){
            $row=[];
            for($value = 1; $value <= 9; $value++){
                $indexInRow = $value - 1;
                $row[$indexInRow] = $value;
            }
            array_push ( $solution , $row );
        }
        return $solution;
    }

    public $level_1_Structure = [[0,0,0,0,3,0,8,0,9],[4,0,2,0,1,0,0,0,5],[9,0,0,8,0,7,0,0,0], [0,4,0,0,0,0,6,3,5],[3,9,0,7,0,0,0,8,2],[2,0,8,0,0,0,9,0,7], [0,0,7,4,0,3,0,5,6],[5,0,4,0,7,0,0,9,0],[6,0,9,0,0,8,0,7,0]];
    public $level_1_Solution = [[1,7,5,6,3,4,8,2,9],[4,8,2,5,1,9,7,6,5],[9,6,3,8,2,7,5,1,4], [7,4,1,9,8,2,6,3,5],[3,9,6,7,4,5,1,8,2],[2,5,8,3,6,1,9,4,7], [8,1,7,4,9,3,2,5,6],[5,2,4,1,7,6,3,9,8],[6,3,9,2,5,8,4,7,1]];
    public $level_2_Solution = [[7,4,2,3,8,5,6,1,9],[9,8,6,4,7,1,2,3,5],[1,3,5,6,9,2,7,8,4], [2,5,1,7,4,8,3,9,6],[4,6,3,2,1,9,5,7,8],[8,7,9,5,6,3,1,4,2], [6,1,7,9,2,4,8,5,3],[5,9,8,1,3,6,4,2,7],[3,2,4,8,5,7,9,6,1]];
    public $level_3_Solution = [[5,8,6,9,2,7,4,3,1],[7,9,1,3,8,4,2,6,5],[4,2,3,1,5,6,8,9,7], [6,1,7,4,9,8,3,5,2],[9,4,5,6,3,2,7,1,8],[2,3,8,7,1,5,6,4,9], [1,6,9,2,7,3,5,8,4],[8,7,4,5,6,9,1,2,3],[3,5,2,8,4,1,9,7,6]];

}
