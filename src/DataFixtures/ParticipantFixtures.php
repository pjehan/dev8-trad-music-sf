<?php

namespace App\DataFixtures;

use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ParticipantFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $participant1 = new Participant();
        $participant1->setGig($this->getReference('gig-1'));
        $participant1->setInstrument($this->getReference('instrument-flute'));
        $manager->persist($participant1);

        $participant2 = new Participant();
        $participant2->setGig($this->getReference('gig-1'));
        $participant2->setInstrument($this->getReference('instrument-guitar'));
        $participant2->setMusician($this->getReference('musician-sean'));
        $manager->persist($participant2);

        $participant3 = new Participant();
        $participant3->setGig($this->getReference('gig-2'));
        $participant3->setInstrument($this->getReference('instrument-guitar'));
        $manager->persist($participant3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            GigFixtures::class,
            InstrumentFixtures::class,
            MusicianFixtures::class,
        ];
    }
}
