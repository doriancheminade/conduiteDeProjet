<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ProjectBundle\Entity\Repository;

class LoadRepo implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {     
        
        /*$r1 = new Repository();
        $r1->setId('1');
        $r1->setType('GITHUB');
        $r1->setOwner('bob');
        $r1->setProject('pacman2015');
        $r1->setRepoOwner('doriancheminade');
        $r1->setRepoName('ScrumToolPacman');
        
        $manager->persist($r1);
        $manager->flush();*/
    }
}
