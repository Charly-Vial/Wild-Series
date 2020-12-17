<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{

    CONST ACTORS = [
        'Andrew Lincoln',
        'Norman Reedus',
        'Lauren Cohan',
        'Danai Gurira'
    ];

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::ACTORS as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $manager->persist($actor);
        }

        $faker = Faker\Factory::create('fr_FR');
        for($i = 0; $i < 30; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name);
            $actor->addProgram($this->getReference('program_' . rand(0, 5)));
            $manager->persist($actor);
        }
        $manager->flush();
    }

}