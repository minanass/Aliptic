<?php

namespace App\DataFixtures;

use App\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GameFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $game = (new Game())
             ->setUser(1)
             ->setGrid(1)
             ->setStartTime(new \DateTime(now))
             ->setEndTime(null)
             ->setNumberOfTests(0);
         $manager->persist($game);

        $manager->flush();
    }
}
