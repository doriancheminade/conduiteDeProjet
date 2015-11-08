<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ProjectBundle\Entity\Task;

class LoadSprintTasks implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $t1 = new Task();
        $t1->setId('T1');
        $t1->setOwner('bob');
        $t1->setProject('pacman2015');
        $t1->setSprint('sprint 1');
        $t1->setDescription('coder la gestion des evenements et les controles de pacman');
        $t1->setCost('7');
        $t1->setPriority('1');
        $t1->setAchievementTask('pouet');          
        //
        $t1 = new Task();
        $t1->setId('T2');
        $t1->setOwner('bob');
        $t1->setProject('pacman2015');
        $t1->setSprint('sprint 1');
        $t1->setDescription('coder l IA des fantomes');
        $t1->setCost('3');
        $t1->setPriority('3');
        $t1->setAchievementTask('pouet');         
        //
        $t1 = new Task();
        $t1->setId('T3');
        $t1->setOwner('bob');
        $t1->setProject('pacman2015');
        $t1->setSprint('sprint 1');
        $t1->setDescription('faire les textures du niveau 1');
        $t1->setCost('4');
        $t1->setPriority('2');
        $t1->setAchievementTask('pouet');       
        
        $manager->persist($t1);
        $manager->persist($t2);
        $manager->persist($t3);
        $manager->flush();
    }
}
