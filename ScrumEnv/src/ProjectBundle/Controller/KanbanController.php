<?php
namespace ProjectBundle\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProjectBundle\Entity\UserStory;
use ProjectBundle\Form\UserStoryForm;

use ProjectBundle\Entity\Repository;
use ProjectBundle\Services\RepositoryManager;

class KanbanController extends Controller
{

     public function visualisationAction($owner, $project, $sprint){
        $em = $this->container->get('doctrine')->getEntityManager();

        $US= $em->getRepository('ProjectBundle:Task')->findBy(
            array('owner' => $owner,
                'project' => $project,
                'sprint' => $sprint));
                
        
        $repo = $em->getRepository('ProjectBundle:Repository')->findOneBy(
            array('owner' => $owner,
                'project' => $project)); 
        $commits = array();
        if($repo){
            $repoManager = new RepositoryManager();
            $commitList = $repoManager->getCommitsAction($repo->getRepoOwner(), $repo->getRepoName());
            $commits = $repoManager->commitsByTaskAction($US, $commitList);
        }
        return $this->container->get('templating')->renderResponse('ProjectBundle:Kanban:Kanban_visualisation.html.twig', 
        array(
        'kanban_us' => $US,
        'owner' => $owner,
        'project' => $project,
        'sprint' => $sprint,
        'commits' => $commits
        ));
    }

public function Update_task_achievementoGAction($owner, $project, $id, $sprint){

   $message = '';
   $up = 'ok';
   $em = $this->container->get('doctrine')->getEntityManager();
   $Task = $em->find('ProjectBundle:Task', $id);
     $US= $em->getRepository('ProjectBundle:Task')->findBy(
        array('owner' => $owner,
            'project' => $project,
            'sprint' => $sprint));
     
   if (!$Task){
    $message = "Aucune tache trouve";
    }

  else{
      $Task -> setAchievementTask("onGoing");
      $em->persist($Task);
      $em->flush();
  }

      $repo = $em->getRepository('ProjectBundle:Repository')->findOneBy(
            array('owner' => $owner,
                'project' => $project)); 
      $commits = array();
      if($repo){
         $repoManager = new RepositoryManager();
         $commitList = $repoManager->getCommitsAction($repo->getRepoOwner(), $repo->getRepoName());
         $commits = $repoManager->commitsByTaskAction($US, $commitList);
      }

return $this->container->get('templating')->renderResponse('ProjectBundle:Kanban:Kanban_visualisation.html.twig',
  array('kanban_us' => $US, 'message' => $message, 'up' => $up,'owner' => $owner, 'project' => $project,'sprint' => $sprint, 'commits' => $commits));
}

public function Update_task_achievementDAction($owner, $project, $id, $sprint){

   $message = '';
   $up = 'ok';
   $em = $this->container->get('doctrine')->getEntityManager();
   $Task = $em->find('ProjectBundle:Task', $id);
      $US= $em->getRepository('ProjectBundle:Task')->findBy(
        array('owner' => $owner,
            'project' => $project,
            'sprint' => $sprint));
   if (!$Task){
    $message = "Aucune tache trouve";
}

else{
    $Task -> setAchievementTask("Done");
    $em->persist($Task);
    $em->flush();
}

      $repo = $em->getRepository('ProjectBundle:Repository')->findOneBy(
            array('owner' => $owner,
                'project' => $project)); 
      $commits = array();
      if($repo){
         $repoManager = new RepositoryManager();
         $commitList = $repoManager->getCommitsAction($repo->getRepoOwner(), $repo->getRepoName());
         $commits = $repoManager->commitsByTaskAction($US, $commitList);
      }

return $this->container->get('templating')->renderResponse('ProjectBundle:Kanban:Kanban_visualisation.html.twig',array('kanban_us' => $US, 'message' => $message, 'up' => $up,'owner' => $owner, 'project' => $project,'sprint' => $sprint, 'commits' => $commits));
}

public function Update_task_achievementToDoAction($owner, $project, $id, $sprint){

   $message = '';
   $up = 'ok';
   $em = $this->container->get('doctrine')->getEntityManager();
   $Task = $em->find('ProjectBundle:Task', $id);
      $US= $em->getRepository('ProjectBundle:Task')->findBy(
        array('owner' => $owner,
            'project' => $project,
            'sprint' => $sprint));
   if (!$Task){
    $message = "Aucune tache trouve";
}

  else{
      $Task -> setAchievementTask("ToDo");
      $em->persist($Task);
      $em->flush();
  }

    $repo = $em->getRepository('ProjectBundle:Repository')->findOneBy(
            array('owner' => $owner,
                'project' => $project)); 
      $commits = array();
      if($repo){
         $repoManager = new RepositoryManager();
         $commitList = $repoManager->getCommitsAction($repo->getRepoOwner(), $repo->getRepoName());
         $commits = $repoManager->commitsByTaskAction($US, $commitList);
      }
return $this->container->get('templating')->renderResponse('ProjectBundle:Kanban:Kanban_visualisation.html.twig',array('commits' => $commits,'kanban_us' => $US, 'message' => $message, 'up' => $up,'owner' => $owner, 'project' => $project,'sprint' => $sprint));
}
}
