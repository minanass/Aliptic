<?php

namespace App\DataFixtures;

use App\Entity\Grid;
//use APP\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class GridFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         
for($i= 1; $i<=10; $i++){

         $grid = new Grid();
         $grid -> setName('mina');
         $grid -> setLevel('1');
         $grid -> setInitialStructure( $i
        );
         
		 $grid -> setSolution('[]');

         /*$game= new Game();
         $game->setGame($game);*/

         
         $manager->persist($grid);
         //$manager->persist($game);
     }
         $manager->flush();
    }
}
