<?php

namespace App\DataFixtures;

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
//            $this->addReference('walking', $program);
        }
        $manager->flush();
    }
}