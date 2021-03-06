<?php

namespace App\DataFixtures;

use App\Entity\Coach;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class CoachFixtures extends Fixture implements DependentFixtureInterface
{
    public const MAX_COACH = 8;
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::MAX_COACH; $i++) {
            $coach = new Coach();
            $coach->setBirthdate(\DateTime::createFromFormat('Y-m-d', "1998-01-01"));
            $coach->setHasVehicle(true);
            $coach->setQualification('BP');
            $coach->setEquipment('Haltères, Corde à sauter, tapis');
            $coach->setBiography('Jeune coach spécialiste en remise en forme');
            $coach->setHourlyRate(50);
            // Replaced the function rand() by the id of the user to avoid the error of duplicated user ids
            $coach->setUser($this->getReference('usercoach_' . $i));
            $coach->addActivity($this->getReference('activity_' .
                rand(0, count(ActivityFixtures::FEATURED_ACTIVITY) - 1)));

            $manager->persist($coach);
            $this->addReference('coach_' . $i, $coach);
        }

        // Fixture for coach's demo account
        $coach = new Coach();
        $coach->setBirthdate(\DateTime::createFromFormat('Y-m-d', "1988-07-01"));
        $coach->setHasVehicle(true);
        $coach->setQualification('BP');
        $coach->setEquipment('tapis');
        $coach->setHourlyRate(50);
        // Replaced the function rand() by the id of the user to avoid the error of duplicated user ids
        $coach->setUser($this->getReference('coach'));
        $coach->addActivity($this->getReference('activity_0'));
        $coach->setBiography('Jeune coach spécialiste en yoga');
        for ($i = 0; $i < CoachBookingFixtures::MAX_BOOKINGS; $i++) {
            $coach->addCoachBooking($this->getReference('booking_' . $i));
        }
        $manager->persist($coach);
        $this->addReference('coach_demo', $coach);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            CoachBookingFixtures::class,
            ActivityFixtures::class
        ];
    }
}
