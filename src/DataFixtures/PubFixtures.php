<?php

namespace App\DataFixtures;

use App\Entity\Pub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PubFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $oconnells = new Pub();
        $oconnells->setName("O'Connell's");
        $oconnells->setImage("oconnell.jpg");
        $oconnells->setAddress("6 Pl. du Parlement de Bretagne");
        $oconnells->setZipCode("35000");
        $oconnells->setCity("Rennes");
        $manager->persist($oconnells);
        $this->addReference("pub-oconnells", $oconnells);

        $templeBar = new Pub();
        $templeBar->setName("Temple Bar");
        $templeBar->setImage("templebar.jpg");
        $templeBar->setAddress("47-48 Temple Bar");
        $templeBar->setZipCode("D02 N725");
        $templeBar->setCity("Dublin");
        $manager->persist($templeBar);
        $this->addReference("pub-templebar", $templeBar);

        $theBrazenHead = new Pub();
        $theBrazenHead->setName("The Brazen Head");
        $theBrazenHead->setImage("thebrazenhead.jpg");
        $manager->persist($theBrazenHead);
        $this->addReference("pub-thebrazenhead", $theBrazenHead);

        $mulligans = new Pub();
        $mulligans->setName("Mulligan's");
        $mulligans->setImage("mulligans.jpg");
        $manager->persist($mulligans);
        $this->addReference("pub-mulligans", $mulligans);

        $manager->flush();
    }
}
