<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ProjectBundle\Entity\Sprint;

class LoadSprint implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $s1 = new Sprint();
        $s1->setId('sprint 1');
        $s1->setOwner('bob');
        $s1->setProject('pacman2015');
        $s1->setDescription('sprint de debug');
        $s1->setDateBegining(new \DateTime('Now'));
        $s1->setDateEnd(new \DateTime('+1 week'));        
        
        $manager->persist($s1);
        $manager->flush();
    }
}
