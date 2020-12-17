<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class SeasonFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $season = new Season();
            $season->setNumber($faker->numberBetween(1, 10));
            $season->setYear($faker->year);
            $season->setDescription($faker->paragraph);
            $season->setProgram($this->getReference('program_' . rand(0, 5)));
            $this->addReference('season_'. $i, $season);
            $manager->persist($season);
        }
        $manager->flush();
    }

}
