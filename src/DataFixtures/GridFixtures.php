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

         $grid = new Grid();
         $grid -> setName('mina');
         $grid -> setLevel('1');
         $grid -> setInitialStructure($i);

		 $grid -> setSolution( $this->creationStructure());

         
         $manager->persist($grid);

         $manager->flush();
    }

    public function creationStructure(){
        $structure =[];
        for($indexRow = 0;$indexRow <= 8; $indexRow++){
            $row=[];
            for($value = 1; $value <= 9; $value++){
                $row[$indexRow] = $value;
            }
            array_push ( $structure , $row );
        }
        return $structure;
    }

}
