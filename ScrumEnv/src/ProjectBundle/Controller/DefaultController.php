<?php
namespace ProjectBundle\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProjectBundle\Entity\UserStory;
use ProjectBundle\Entity\Task;
use ProjectBundle\Entity\Sprint;
use ProjectBundle\Entity\Project;
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
            ->add('Id','text')
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
            ->add('Id','text')
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

      public function Add_TaskAction($owner, $project, $sprint){
        $up ='';
        $message = '';
        $Task = new Task();

        $form = $this->createFormBuilder($Task)
            ->add('id','text')
            ->add('description','text')
            ->add('cost','text')
            ->add('dependencies','text')
         ->getForm();

         $Task -> setAchievementTask('ToDo');
         $Task -> setOwner($owner);
         $Task -> setProject($project);
         $Task -> setSprint($sprint);
         $request = $this->container->get('request');

          if ($request->getMethod() == 'POST') 
          {

            $form->bind($request);
            if ($form->isValid()) 
            {
               $em = $this->container->get('doctrine')->getEntityManager();
               $em->persist($Task);
               $em->flush();
               $message='Tache ajouté avec succès !';
           }
        }

        return $this->container->get('templating')->renderResponse('ProjectBundle:Sprint:Add_Task.html.twig',array(
        'form' => $form->createView(), 'message' => $message,'up' => $up, 'owner' => $owner, 'project' => $project, 'sprint' => $sprint));
    }
 public function list_TaskAction($owner, $project, $sprint){
        $em = $this->container->get('doctrine')->getEntityManager();

        $Task= $em->getRepository('ProjectBundle:Task')->findBy(
            array('owner' => $owner,
                'project' => $project,
                'sprint' => $sprint));

        return $this->container->get('templating')->renderResponse('ProjectBundle:Sprint:TaskList.html.twig', 
        array(
        'message' => $Task, 'owner' => $owner, 'project' => $project, 'sprint' => $sprint
        ));
        
    }
     public function Update_TaskAction($owner, $project, $sprint, $id){

         $message = '';
         $up = 'ok';
         $em = $this->container->get('doctrine')->getEntityManager();
         $Task = $em->getRepository('ProjectBundle:Task')
            ->findOneBy(
            array('owner' => $owner,
                'project' => $project,
                'id' => $id));

         if (!$Task){
            $message = "no US found";
         }

         $form = $this->createFormBuilder($Task)
            ->add('id','text')
            ->add('description','text')
            ->add('cost','text')
            ->add('dependencies','text')
         ->getForm();


         $request = $this->container->get('request');

        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);

            if ($form->isValid()) 
            {
                $em->persist($Task);
                $em->flush();
                $message='Tache modifié avec succès !';
            }
            else{
                $message = 'Form not valid';
            }
         }

          return $this->container->get('templating')->renderResponse('ProjectBundle:Sprint:Add_Task.html.twig',array(
        'form' => $form->createView(), 'message' => $message, 'up' => $up, 'owner' => $owner, 'project' => $project, 'sprint' => $sprint));
    }

     public function Delete_TaskAction($owner, $project,$sprint, $id)
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $User_Story = $em->getRepository('ProjectBundle:Task')
            ->findOneBy(
            array('owner' => $owner,
                'project' => $project,
                'sprint' => $sprint,
                'Id' => $id));
            
        if (!$User_Story) 
        {
           throw new NotFoundHttpException("User_Story not found");
        }
            
        $em->remove($User_Story);
        $em->flush();        


      return new RedirectResponse($this->container->get('router')->generate('go_to_task_list', array('owner' => $owner, 'project' => $project, 'sprint' => $sprint)));
    }



     
}
