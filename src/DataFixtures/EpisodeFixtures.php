<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for($i = 0; $i < 30; $i++) {
            $episode = new Episode();
            $episode->setTitle($faker->word);
            $episode->setNumber($faker->numberBetween(1, 10));
            $episode->setSynopsis($faker->text);
            $episode->setSeason($this->getReference('season_' . rand(0,4)));
            $manager->persist($episode);
        }
        $manager->flush();
    }


}
