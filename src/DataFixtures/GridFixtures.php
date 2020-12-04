<?php

namespace App\DataFixtures;

use App\Entity\Grid;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class GridFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $grid = new Grid();
         $grid -> setName('mina');
         $grid -> setLevel('1');
		 $grid -> setInitialStructure('1');
		 $grid -> setSolution('');
         $manager->persist($grid);
         $manager->flush();
    }
}
