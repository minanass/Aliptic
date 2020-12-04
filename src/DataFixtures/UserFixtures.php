<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
	public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('Mario');
        $password = $this->encoder->encodePassword($user, 'Peach');
        $user->setPassword($password);
        $user->setEmail('mario@mushroom.com');
        $user->setRoles(['ROLE_User']);
        $user->setScore(4);
        $user->setLevel(1);


        
        $manager->persist($user);

        $manager->flush();
    }
}
