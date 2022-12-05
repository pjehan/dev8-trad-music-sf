<?php

namespace App\DataFixtures;

use App\Entity\Musician;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MusicianFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $john = new Musician();
        $john->setEmail('john.doe@gmail.com');
        $john->setPassword($this->hasher->hashPassword($john, 'john'));
        $john->setFirstName('John');
        $john->setLastName('Doe');
        $john->addInstrument($this->getReference('instrument-flute'));
        $john->setRoles(['USER_MUSICIAN']);
        $manager->persist($john);
        $this->addReference('musician-john', $john);

        $sean = new Musician();
        $sean->setEmail('sean.obroin@gmail.com');
        $sean->setPassword($this->hasher->hashPassword($sean, 'sean'));
        $sean->setFirstName('Sean');
        $sean->setLastName('O\'Broin');
        $sean->setImage('sean-obroin.jpeg');
        $sean->setRoles(['USER_MUSICIAN']);
        $sean->addInstrument($this->getReference('instrument-flute'));
        $manager->persist($sean);
        $this->addReference('musician-sean', $sean);

        $gavin = new Musician();
        $gavin->setEmail('gavin.pennycook@gmail.com');
        $gavin->setPassword($this->hasher->hashPassword($gavin, 'gavin'));
        $gavin->setFirstName('Gavin');
        $gavin->setLastName('Pennycook');
        $gavin->setImage('gavin-pennycook.jpg');
        $gavin->addInstrument($this->getReference('instrument-flute'));
        $gavin->addInstrument($this->getReference('instrument-fiddle'));
        $gavin->setRoles(['USER_MUSICIAN']);
        $manager->persist($gavin);
        $this->addReference('musician-gavin', $gavin);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [InstrumentFixtures::class];
    }
}
