<?php

namespace App\DataFixtures;

use App\Entity\Gig;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GigFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $today = new \DateTimeImmutable();

        $gig1 = new Gig();
        $gig1->setDateStart($today->modify('+2 day'));
        $gig1->setPub($this->getReference('pub-oconnells'));
        $manager->persist($gig1);
        $this->addReference('gig-1', $gig1);

        $gig2 = new Gig();
        $gig2->setDateStart($today->modify('-1 month'));
        $gig2->setDateEnd($gig2->getDateStart()->modify('+2 hour'));
        $gig2->setPub($this->getReference('pub-oconnells'));
        $manager->persist($gig2);
        $this->addReference('gig-2', $gig2);

        $gig3 = new Gig();
        $gig3->setDateStart($today->modify('+2 day'));
        $gig3->setPub($this->getReference('pub-templebar'));
        $manager->persist($gig3);
        $this->addReference('gig-3', $gig3);

        $gig4 = new Gig();
        $gig4->setDateStart($today->modify('+1 day'));
        $gig4->setPub($this->getReference('pub-mulligans'));
        $manager->persist($gig4);
        $this->addReference('gig-4', $gig4);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [PubFixtures::class]; // PubFixtures::class === 'App\Fixtures\PubFixtures'
    }
}
