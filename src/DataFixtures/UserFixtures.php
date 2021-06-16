<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    public const MAX_USERS = 10;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < self::MAX_USERS; $i++) {
            $user = new User();
            $user->setFirstname($faker->firstName());
            $user->setLastname($faker->lastName());
            $user->setTelephone($faker->phoneNumber());
            $user->setEmail($faker->email());

            $manager->persist($user);
            $this->addReference('user_' . $i, $user);
        }
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
