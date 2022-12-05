<?php

namespace App\DataFixtures;

use App\Entity\Manager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ManagerFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $oconnellsManager = new Manager();
        $oconnellsManager->setEmail('manager@oconnells.com');
        $oconnellsManager->setPassword($this->hasher->hashPassword($oconnellsManager, 'oconnells'));
        $oconnellsManager->setRoles(['USER_MANAGER']);
        $manager->persist($oconnellsManager);
        $this->addReference('manager-oconnells', $oconnellsManager);

        $templebarManager = new Manager();
        $templebarManager->setEmail('manager@templebar.com');
        $templebarManager->setPassword($this->hasher->hashPassword($templebarManager, 'templebar'));
        $templebarManager->setRoles(['USER_MANAGER']);
        $manager->persist($templebarManager);
        $this->addReference('manager-templebar', $templebarManager);

        $thebrazenheadManager = new Manager();
        $thebrazenheadManager->setEmail('manager@thebrazenhead.com');
        $thebrazenheadManager->setPassword($this->hasher->hashPassword($thebrazenheadManager, 'thebrazenhead'));
        $thebrazenheadManager->setRoles(['USER_MANAGER']);
        $manager->persist($thebrazenheadManager);
        $this->addReference('manager-thebrazenhead', $thebrazenheadManager);

        $mulligansManager = new Manager();
        $mulligansManager->setEmail('manager@mulligans.com');
        $mulligansManager->setPassword($this->hasher->hashPassword($mulligansManager, 'mulligans'));
        $mulligansManager->setRoles(['USER_MANAGER']);
        $manager->persist($mulligansManager);
        $this->addReference('manager-mulligans', $mulligansManager);

        $manager->flush();
    }
}
