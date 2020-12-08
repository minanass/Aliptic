<?php

namespace App\DataFixtures;

use App\Entity\Ranking;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RankingFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $ranking = (new Ranking())
            ->setName("Classement général");
        $manager->persist($ranking);

        $manager->flush();
    }
}
