<?php

namespace App\DataFixtures;

use App\Entity\TrainingSpace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TrainingSpaceFixtures extends Fixture
{
    private const TRAINING_SPACE = [
        [
            'name' => 'CLUB ENERGIE CENTRE',
            'address' => '30 Boulevard Rocheplatte',
            'description' => 'Salles de sport santé à Orléans depuis 33 ans',
            'photo' => 'https://bit.ly/3cpnieI',
        ],

        [
            'name' => 'CLUB FEEL SPORT ORLÉANS',
            'address' => 'Place du Châtelet',
            'description' => 'La salle de sport qui fait du bien',
            'photo' => 'https://bit.ly/3cr3aJ2',
        ],
        [
            'name' => 'CLUB MAGIC FORM ORLÉANS',
            'address' => '30 Boulevard Rocheplatte',
            'description' => 'Votre salle de sport tout compris',
            'photo' => 'https://bit.ly/3gbrz7O',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::TRAINING_SPACE as $trainingSpaceDetails) {
            $trainingSpaces = new TrainingSpace();
            $trainingSpaces->setName($trainingSpaceDetails['name']);
            $trainingSpaces->setDescription($trainingSpaceDetails['description']);
            $trainingSpaces->setPhoto($trainingSpaceDetails['photo']);
            $trainingSpaces->setAddress($trainingSpaceDetails['address']);
            $manager->persist($trainingSpaces);
        }
        $manager->flush();
    }
}