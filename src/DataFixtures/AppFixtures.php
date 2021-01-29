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

        /*  
         *   Création d'users avec differents niveaux 
        */
        $user = new User();
        $user->setUsername('Mario');
        $password = $this->encoder->encodePassword($user, '123456');
        $user->setPassword($password);
        $user->setEmail('mario@mushroom.com');
        $user->setRoles(['ROLE_User']);
        $user->setScore(0);
        $user->setLevel(1);
        $manager->persist($user);

        $user2 = new User();
        $user2->setUsername('Peach');
        $password = $this->encoder->encodePassword($user2, '123456');
        $user2->setPassword($password);
        $user2->setEmail('peach@mushroom.com');
        $user2->setRoles(['ROLE_User']);
        $user2->setScore(4);
        $user2->setLevel(2);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('Luigi');
        $password = $this->encoder->encodePassword($user3, '123456');
        $user3->setPassword($password);
        $user3->setEmail('luigi@mushroom.com');
        $user3->setRoles(['ROLE_User']);
        $user3->setScore(8);
        $user3->setLevel(3);
        $manager->persist($user3);

        $admin = new User();
        $admin->setUsername('Admin');
        $password = $this->encoder->encodePassword($admin, '123456');
        $admin->setPassword($password);
        $admin->setEmail('admin@mushroom.com');
        $admin->setRoles(['ROLE_Admin']);
        $admin->setScore(0);
        $admin->setLevel(1);
        $manager->persist($admin);

        /*
         *  Création de grid avec plusieurs niveaux de complexité
        */
        //grid level 1
        $grid_1_level_1 = (new Grid())
            -> setName('Grid_1_level_1')
            -> setLevel('1')
            -> setInitialStructure($this->structure_grid_1_level_1)
            -> setSolution($this->solution_grid_1_level_1);
        $manager->persist($grid_1_level_1);

        $grid_2_level_1 = (new Grid())
            -> setName('Grid_2_level_1')
            -> setLevel('1')
            -> setInitialStructure($this->structure_grid_2_level_1)
            -> setSolution($this->solution_grid_2_level_1);
        $manager->persist($grid_2_level_1);

        $grid_3_level_1 = (new Grid())
            -> setName('Grid_3_level_1')
            -> setLevel('1')
            -> setInitialStructure($this->structure_grid_3_level_1)
            -> setSolution($this->solution_grid_3_level_1);
        $manager->persist($grid_3_level_1);

        //grid level 2
        $grid_1_level_2 = (new Grid())
            -> setName('Grid_1_level_2')
            -> setLevel('2')
            -> setInitialStructure($this->structure_grid_1_level_2)
            -> setSolution($this->solution_grid_1_level_2);
        $manager->persist($grid_1_level_2);

        $grid_2_level_2 = (new Grid())
            -> setName('Grid_2_level_2')
            -> setLevel('2')
            -> setInitialStructure($this->structure_grid_2_level_2)
            -> setSolution($this->solution_grid_2_level_2);
        $manager->persist($grid_2_level_2);

        $grid_3_level_2 = (new Grid())
            -> setName('Grid_3_level_2')
            -> setLevel('2')
            -> setInitialStructure($this->structure_grid_3_level_2)
            -> setSolution($this->solution_grid_3_level_2);
        $manager->persist($grid_3_level_2);

        //grid level 3
        $grid_1_level_3 = (new Grid())
            -> setName('Grid_1_level_3')
            -> setLevel('3')
            -> setInitialStructure($this->structure_grid_1_level_3)
            -> setSolution($this->solution_grid_1_level_3);
        $manager->persist($grid_1_level_3);

        $grid_2_level_3 = (new Grid())
            -> setName('Grid_2_level_3')
            -> setLevel('3')
            -> setInitialStructure($this->structure_grid_2_level_3)
            -> setSolution($this->solution_grid_2_level_3);
        $manager->persist($grid_2_level_3);

        $grid_3_level_3 = (new Grid())
            -> setName('Grid_3_level_3')
            -> setLevel('3')
            -> setInitialStructure($this->structure_grid_3_level_3)
            -> setSolution($this->solution_grid_3_level_3);
        $manager->persist($grid_3_level_3);
        
        
        /*
         *  Création de game associant les niveaux des utilisateurs à celui des grids
        */
        $game = (new Game())
            ->setUser($user)
            ->setGrid($grid_1_level_1)
            ->setStartTime(new \DateTime('NOW'))
            ->setEndTime()
            ->setResult(0)
            ->setNumberOfTests(0);
        $manager->persist($game);

        $game2 = (new Game())
            ->setUser($user2)
            ->setGrid($grid_2_level_2)
            ->setStartTime(new \DateTime('NOW'))
            ->setEndTime()
            ->setResult(0)
            ->setNumberOfTests(0);
        $manager->persist($game2);

        $game3 = (new Game())
            ->setUser($user3)
            ->setGrid($grid_3_level_3)
            ->setStartTime(new \DateTime('NOW'))
            ->setEndTime()
            ->setResult(0)
            ->setNumberOfTests(0);
        $manager->persist($game3);

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

    //public $level_1_Structure = [[0,0,0,0,3,0,8,0,9],[4,0,2,0,1,0,0,0,5],[9,0,0,8,0,7,0,0,0], [0,4,0,0,0,0,6,3,5],[3,9,0,7,0,0,0,8,2],[2,0,8,0,0,0,9,0,7], [0,0,7,4,0,3,0,5,6],[5,0,4,0,7,0,0,9,0],[6,0,9,0,0,8,0,7,0]];
    public $solution_grid_1_level_1 = [[6,7,8,5,9,3,1,4,2],[2,5,3,7,4,1,6,9,8],[1,9,4,6,8,2,7,5,3], [7,4,9,3,2,6,5,8,1],[5,2,6,8,1,7,9,3,4],[8,3,1,9,5,4,2,7,6], [4,8,5,2,6,9,3,1,7],[9,6,7,1,3,8,4,2,5],[3,1,2,4,7,5,8,6,9]];
    public $structure_grid_1_level_1 = [[0,7,8,5,9,0,1,0,2],[0,5,0,7,0,1,0,9,8],[0,9,0,0,0,0,0,5,0], [0,0,9,3,2,0,0,8,1],[5,0,0,8,1,0,0,0,0],[0,0,1,0,0,0,2,7,6], [4,0,0,2,6,0,3,0,7],[0,0,0,1,3,8,0,2,5],[3,0,2,4,7,0,0,0,9]];
    public $solution_grid_2_level_1 = [[1,7,8,5,2,4,6,9,3],[2,5,3,8,6,9,4,7,1],[6,4,9,3,1,7,5,8,2], [7,6,4,9,8,2,1,3,5],[9,3,2,4,5,1,7,6,8],[8,1,5,6,7,3,9,2,4], [4,8,1,2,9,6,3,5,7],[5,9,7,1,3,8,2,4,6],[3,2,6,7,4,5,8,1,9]];
    public $structure_grid_2_level_1 = [[1,0,0,0,0,0,6,9,3],[2,5,0,0,6,0,0,7,1],[6,4,0,3,0,7,0,8,2], [0,0,0,9,0,0,1,3,5],[9,3,2,4,5,1,0,0,8],[8,1,5,6,0,0,0,2,4], [4,0,1,0,0,0,3,0,7],[0,0,7,0,0,0,0,0,0],[3,0,0,7,0,0,8,0,0]];
    public $solution_grid_3_level_1 = [[2,3,6,1,4,8,7,9,5],[5,7,4,6,9,2,3,8,1],[9,1,8,5,3,7,2,6,4], [1,5,3,9,6,4,8,7,2],[4,6,7,8,2,3,1,5,9],[8,2,9,7,5,1,4,3,6], [3,9,2,4,7,6,5,1,8],[6,4,1,3,8,5,9,2,7],[7,8,5,2,1,9,6,4,3]];
    public $structure_grid_3_level_1 = [[0,0,6,0,0,8,0,9,5],[5,0,0,6,9,2,3,8,0],[0,1,8,0,3,0,0,0,0], [1,0,3,0,6,0,0,7,0],[4,0,7,8,0,3,0,0,0],[8,0,0,0,5,0,4,3,6], [0,9,0,4,7,0,5,0,8],[6,0,1,0,0,0,9,0,7],[7,0,5,0,0,9,6,0,3]];

    public $solution_grid_1_level_2 = [[7,8,5,4,6,9,1,3,2],[4,3,2,7,5,1,6,8,9],[1,6,9,3,2,8,7,5,4],[3,1,7,5,8,4,2,9,6],[2,9,6,1,3,7,5,4,8],[8,5,4,6,9,2,3,1,7],[6,7,8,9,1,3,4,2,5],[9,4,1,2,7,5,8,6,3],[5,2,3,8,4,6,9,7,1]];
    public $structure_grid_1_level_2 = [[0,0,5,4,0,0,0,3,0],[0,0,2,7,5,0,0,8,9],[1,6,0,3,0,8,7,0,0],[0,0,0,0,0,0,2,9,0],[0,9,0,0,0,0,0,0,0],[0,0,0,6,9,0,0,0,7],[6,0,8,0,0,0,4,2,0],[0,4,1,0,0,0,0,6,3],[0,2,0,0,0,6,0,0,1]];
    public $solution_grid_2_level_2 = [[9,6,5,4,1,3,7,2,8],[3,2,7,6,9,8,1,4,5],[4,8,1,7,5,2,9,6,3],[5,7,8,9,4,1,2,3,6],[1,4,3,8,2,6,5,7,9],[6,9,2,3,7,5,8,1,4],[2,1,4,5,6,9,3,8,7],[7,3,9,2,8,4,6,5,1],[8,5,6,1,3,7,4,9,2]];
    public $structure_grid_2_level_2 = [[9,6,5,4,0,0,0,2,0],[3,0,7,0,0,8,0,4,0],[0,0,0,0,0,2,9,0,0],[0,0,8,0,0,1,0,3,0],[1,4,3,0,0,0,0,0,0],[6,0,2,0,7,0,8,1,0],[0,0,0,5,6,9,0,0,0],[0,0,9,0,8,0,6,0,0],[0,0,0,0,0,0,0,9,2]];
    public $solution_grid_3_level_2 = [[2,8,4,1,3,9,7,5,6],[5,6,1,7,2,4,3,9,8],[7,3,9,6,8,5,4,1,2],[1,9,6,5,7,3,2,8,4],[4,5,3,8,6,2,1,7,9],[8,7,2,9,4,1,5,6,3],[3,1,7,4,9,6,8,2,5],[9,4,8,2,5,7,6,3,1],[6,2,5,3,1,8,9,4,7]];    
    public $structure_grid_3_level_2 = [[0,8,0,1,0,0,7,5,0],[0,6,0,0,2,0,3,9,0],[7,3,9,6,8,0,0,0,2],[1,0,0,0,0,0,2,0,0],[4,0,0,8,6,0,0,0,0],[0,0,2,0,0,1,0,0,3],[0,1,7,4,0,0,0,0,0],[0,0,0,0,0,0,0,0,0],[6,2,0,0,0,8,9,0,7]];

    public $solution_grid_1_level_3 = [[4,3,6,2,9,8,7,5,1],[8,1,5,3,6,7,2,4,9],[2,7,9,1,4,5,3,8,6],[3,8,2,7,5,1,6,9,4],[6,5,7,9,3,4,1,2,8],[9,4,1,6,8,2,5,3,7],[7,6,8,5,2,9,4,1,3],[1,2,4,8,7,3,9,6,5],[5,9,3,4,1,6,8,7,2]];    
    public $structure_grid_1_level_3 = [[4,0,0,0,0,8,7,0,0],[0,0,5,3,0,0,0,0,9],[0,0,0,1,4,0,0,0,0],[0,0,2,0,0,0,6,0,0],[0,0,0,0,0,0,1,0,0],[0,0,0,6,0,0,0,3,0],[0,0,8,0,0,9,4,0,3],[1,0,0,0,7,0,0,0,5],[0,9,0,0,1,0,8,0,0]];
    public $solution_grid_2_level_3 = [[5,6,2,7,9,4,8,1,3],[4,3,8,2,5,1,7,6,9],[7,1,9,6,8,3,5,4,2],[9,5,6,1,3,7,2,8,4],[1,4,3,8,2,9,6,7,5],[2,8,7,4,6,5,3,9,1],[6,7,1,5,4,2,9,3,8],[3,2,4,9,7,8,1,5,6],[8,9,5,3,1,6,4,2,7]];
    public $structure_grid_2_level_3 = [[0,0,2,7,0,0,0,0,3],[0,0,0,0,0,1,7,0,9],[0,0,0,0,8,0,5,0,0],[0,0,6,0,0,0,0,8,0],[0,4,0,0,0,9,0,0,5],[0,0,7,4,0,5,3,0,1],[6,0,1,0,0,0,9,0,0],[0,0,0,0,0,0,0,0,0],[8,0,0,3,0,0,0,2,0]];
    public $solution_grid_3_level_3 = [[3,6,2,9,5,1,8,7,4],[4,7,9,8,3,2,6,5,1],[1,8,5,7,6,4,3,9,2],[5,2,3,4,7,8,9,1,6],[8,1,6,3,9,5,4,2,7],[9,4,7,1,2,6,5,8,3],[6,3,1,5,8,7,2,4,9],[7,9,8,2,4,3,1,6,5],[2,5,4,6,1,9,7,3,8]];
    public $structure_grid_3_level_3 = [[3,0,0,0,0,1,0,7,0],[0,0,0,0,3,0,6,0,0],[0,0,5,7,0,4,0,0,2],[0,2,0,0,7,0,0,1,6],[8,1,0,0,0,0,0,2,0],[0,4,0,0,0,0,5,0,0],[6,0,0,0,0,0,0,0,9],[7,9,0,2,0,3,0,0,0],[0,0,0,0,1,0,0,0,8]];
}