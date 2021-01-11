<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
        $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {

        // Création d’un utilisateur de type “contributeur” (= auteur)
        $contributor = new User();
        $contributor->setUsername('Toto');
        $contributor->setBio('la biographie du gars qui met des commentaires');
        $contributor->setEmail('contributor@monsite.com');
        $contributor->setRoles(['ROLE_CONTRIBUTOR']);
        $contributor->setPassword($this->passwordEncoder->encodePassword(
            $contributor,
            'contributorpassword'
        ));
        $manager->persist($contributor);
        $this->addReference('Toto', $contributor);

        // Création d’un utilisateur de type “administrateur”
        $admin = new User();
        $admin->setEmail('admin@monsite.com');
        $admin->setUsername('Boss');
        $admin->setBio('la biographie de l\'administrateur');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));
        $manager->persist($admin);
        $this->addReference('admin', $admin);

        // Création d’un second utilisateur de type “contributeur” (= auteur)
        $contributor2 = new User();
        $contributor2->setUsername('Tata');
        $contributor2->setBio('la biographie du gars qui met des commentaires');
        $contributor2->setEmail('contributor2@monsite.com');
        $contributor2->setRoles(['ROLE_CONTRIBUTOR']);
        $contributor2->setPassword($this->passwordEncoder->encodePassword(
            $contributor2,
            'contributor2password'
        ));
        $manager->persist($contributor2);
        $this->addReference('Tata', $contributor2);

        // Sauvegarde des 3 nouveaux utilisateurs :
        $manager->flush();
    }

}