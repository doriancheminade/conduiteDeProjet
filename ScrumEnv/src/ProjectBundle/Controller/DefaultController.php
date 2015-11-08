<?php
namespace ProjectBundle\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProjectBundle\Entity\UserStory;
use ProjectBundle\Form\UserStoryForm;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProjectBundle:Default:index.html.twig', array('name' => $name));
    }

    public function naviguerAction()
    {
    	$message = "hey";
    	return $this->render('ProjectBundle:Default:backlog.html.twig', array('message' => $message ));
    }
    
    public function ProjectOverviewAction($owner, $project){
        $em = $this->getDoctrine()->getManager();
        $sprints = $em->getRepository('ProjectBundle:Sprint')
            ->findBy(
                array('owner' => $owner,
                    'project' => $project),
                array('id' => 'ASC')
             );
    
        return $this->render('ProjectBundle:Default:ProjectOverview.html.twig', array('owner' => $owner, 'project' => $project, 'sprints' => $sprints));
    }

    public function listAction($owner, $project)
    {
    	$em = $this->container->get('doctrine')->getEntityManager();

        $US= $em->getRepository('ProjectBundle:UserStory')
            ->findBy(
                array('owner' => $owner,
                    'project' => $project),
                array('id' => 'ASC')
             );

        return $this->container->get('templating')->renderResponse('ProjectBundle:Default:backlog.html.twig', 
        array(
        'message' => $US
        ));
        
    }


   public function Add_UsAction($owner, $project){

        $up ='';
        $message = '';
        $User_Story = new UserStory(); 

         $form = $this->createFormBuilder($User_Story)
            ->add('description','text')
            ->add('priority','text')
            ->add('cost','text')
            ->getForm();

        $User_Story -> setOwner($owner); 
        $User_Story -> setProject($project);

         $request = $this->container->get('request');

          if ($request->getMethod() == 'POST') 
          {
            $form->bind($request);
           $message =  $User_Story -> getId();
           
            if ($form->isValid()) 
            {

               $em = $this->container->get('doctrine')->getEntityManager();
               $em->persist($User_Story);
               $em->flush();
               $message='User Story succesfully added';
           }
        }

        return $this->container->get('templating')->renderResponse('ProjectBundle:Default:Add_Us.html.twig',array(
        'form' => $form->createView(), 'message' => $message,'up' => $up));
    }

    public function Delete_UsAction($owner, $project, $id)
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $User_Story = $em->getRepository('ProjectBundle:UserStory')
            ->findOneBy(
            array('owner' => $owner,
                'project' => $project,
                'id' => $id));
            
        if (!$User_Story) 
        {
           throw new NotFoundHttpException("User_Story not found");
        }
            
        $em->remove($User_Story);
        $em->flush();        


      return new RedirectResponse($this->container->get('router')->generate('go_to_backlog', array('owner' => $owner, 'project' => $project)));
    }

    public function Update_UsAction($owner, $project, $id)
    {

         $message = '';
         $up = 'ok';
         $em = $this->container->get('doctrine')->getEntityManager();
         $User_Story = $em->getRepository('ProjectBundle:UserStory')
            ->findOneBy(
            array('owner' => $owner,
                'project' => $project,
                'id' => $id));

         if (!$User_Story){
            $message = "no US found";
         }

        $form = $this -> createFormBuilder($User_Story)
            ->add('description','text')
            ->add('priority','text')
            ->add('cost','text')
         ->getForm();

         $request = $this->container->get('request');

        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);

            if ($form->isValid()) 
            {
                $em->persist($User_Story);
                $em->flush();
                $message='US succesfully modified';
            }
         }

          return $this->container->get('templating')->renderResponse('ProjectBundle:Default:Add_Us.html.twig',array(
        'form' => $form->createView(), 'message' => $message, 'up' => $up));
    }


     public function visualisationAction($owner, $project){
        $em = $this->container->get('doctrine')->getEntityManager();

        $US= $em->getRepository('ProjectBundle:Task')->findBy(
            array('owner' => $owner,
                'project' => $project));

        return $this->container->get('templating')->renderResponse('ProjectBundle:Kanban:Kanban_visualisation.html.twig', 
        array(
        'kanban_us' => $US,
        'owner' => $owner,
        'project' => $project
        ));
    }

    public function Update_task_achievementoGAction($owner, $project, $id){

         $message = '';
         $up = 'ok';
         $em = $this->container->get('doctrine')->getEntityManager();
         $Task = $em->find('ProjectBundle:Task', $id);
         $US= $em->getRepository('ProjectBundle:Task')->findAll();


         if (!$Task){
            $message = "Aucune tache trouve";
         }

         else{
            $Task -> setAchievementTask("onGoing");
            $em->persist($Task);
            $em->flush();
         }
          return $this->container->get('templating')->renderResponse('ProjectBundle:Kanban:Kanban_visualisation.html.twig',array('kanban_us' => $US, 'message' => $message, 'up' => $up,'owner' => $owner, 'project' => $project));
    }

    public function Update_task_achievementDAction($owner, $project, $id){

         $message = '';
         $up = 'ok';
         $em = $this->container->get('doctrine')->getEntityManager();
         $Task = $em->find('ProjectBundle:Task', $id);
          $US= $em->getRepository('ProjectBundle:Task')->findAll();
         if (!$Task){
            $message = "Aucune tache trouve";
         }

         else{
            $Task -> setAchievementTask("Done");
            $em->persist($Task);
            $em->flush();
         }
          return $this->container->get('templating')->renderResponse('ProjectBundle:Kanban:Kanban_visualisation.html.twig',array('kanban_us' => $US, 'message' => $message, 'up' => $up,'owner' => $owner, 'project' => $project));
    }

    public function Update_task_achievementToDoAction($owner, $project, $id){

         $message = '';
         $up = 'ok';
         $em = $this->container->get('doctrine')->getEntityManager();
         $Task = $em->find('ProjectBundle:Task', $id);
          $US= $em->getRepository('ProjectBundle:Task')->findAll();
         if (!$Task){
            $message = "Aucune tache trouve";
         }

         else{
            $Task -> setAchievementTask("ToDo");
            $em->persist($Task);
            $em->flush();
         }
          return $this->container->get('templating')->renderResponse('ProjectBundle:Kanban:Kanban_visualisation.html.twig',array('kanban_us' => $US, 'message' => $message, 'up' => $up,'owner' => $owner, 'project' => $project));
    }
}
