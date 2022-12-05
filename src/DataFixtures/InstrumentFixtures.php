<?php

namespace App\DataFixtures;

use App\Entity\Instrument;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InstrumentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $flute = new Instrument();
        $flute->setName('Flute');
        $this->addReference('instrument-flute', $flute);
        $manager->persist($flute);

        $guitar = new Instrument();
        $guitar->setName('Guitar');
        $guitar->setIcon('fa-solid fa-guitar');
        $this->addReference('instrument-guitar', $guitar);
        $manager->persist($guitar);

        $fiddle = new Instrument();
        $fiddle->setName('Fiddle');
        $this->addReference('instrument-fiddle', $fiddle);
        $manager->persist($fiddle);

        $manager->flush();
    }
}
