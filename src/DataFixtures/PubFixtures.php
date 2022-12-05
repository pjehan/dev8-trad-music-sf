<?php

namespace App\DataFixtures;

use App\Entity\Pub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PubFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $oconnells = new Pub();
        $oconnells->setName("O'Connell's");
        $oconnells->setImage("oconnell.jpg");
        $oconnells->setAddress("6 Pl. du Parlement de Bretagne");
        $oconnells->setZipCode("35000");
        $oconnells->setCity("Rennes");
        $oconnells->setManager($this->getReference('manager-oconnells'));
        $manager->persist($oconnells);
        $this->addReference("pub-oconnells", $oconnells);

        $templeBar = new Pub();
        $templeBar->setName("Temple Bar");
        $templeBar->setImage("templebar.jpg");
        $templeBar->setAddress("47-48 Temple Bar");
        $templeBar->setZipCode("D02 N725");
        $templeBar->setCity("Dublin");
        $templeBar->setManager($this->getReference('manager-templebar'));
        $manager->persist($templeBar);
        $this->addReference("pub-templebar", $templeBar);

        $theBrazenHead = new Pub();
        $theBrazenHead->setName("The Brazen Head");
        $theBrazenHead->setImage("thebrazenhead.jpg");
        $theBrazenHead->setManager($this->getReference('manager-thebrazenhead'));
        $manager->persist($theBrazenHead);
        $this->addReference("pub-thebrazenhead", $theBrazenHead);

        $mulligans = new Pub();
        $mulligans->setName("Mulligan's");
        $mulligans->setImage("mulligans.jpg");
        $mulligans->setManager($this->getReference('manager-mulligans'));
        $manager->persist($mulligans);
        $this->addReference("pub-mulligans", $mulligans);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ManagerFixtures::class];
    }
}
