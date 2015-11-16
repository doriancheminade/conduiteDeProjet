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
        $t1->setAchievementTask('ToDo');      
        $t1->setDependencies('');    
        //
        $t2 = new Task();
        $t2->setId('T2');
        $t2->setOwner('bob');
        $t2->setProject('pacman2015');
        $t2->setSprint('sprint 1');
        $t2->setDescription('coder l IA des fantomes');
        $t2->setCost('3');
        $t2->setAchievementTask('onGoing');      
        $t2->setDependencies('');           
        //
        $t3 = new Task();
        $t3->setId('T3');
        $t3->setOwner('bob');
        $t3->setProject('pacman2015');
        $t3->setSprint('sprint 1');
        $t3->setDescription('faire les textures du niveau 1');
        $t3->setCost('4');
        $t3->setAchievementTask('Done');      
        $t3->setDependencies('');   
        $t3->setDateBeginingReal(new \DateTime('2015-11-09 10:00:00', new \DateTimeZone('UTC')));  
        $t3->setDateEndReal(new \DateTime('2015-11-09 16:30:30', new \DateTimeZone('UTC'))); 
        $t3->setDeveloper("bob");          
        
        $manager->persist($t1);
        $manager->persist($t2);
        $manager->persist($t3);
        $manager->flush();
    }
}
