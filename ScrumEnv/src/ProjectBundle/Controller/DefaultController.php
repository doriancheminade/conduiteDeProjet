<?php
namespace ProjectBundle\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProjectBundle\Entity\UserStory;
use ProjectBundle\Entity\Task;
use ProjectBundle\Entity\Sprint;
use ProjectBundle\Entity\Project;
use ProjectBundle\Form\UserStoryForm;

class DefaultController extends Controller
{
    
    public function usersAction(){

       // On récupère le service
        $security = $this->container->get('security.context');

        // On récupère le token
        $token = $security->getToken();

        // Si la requête courante n'est pas derrière un pare-feu, $token est null
        // Sinon, on récupère l'utilisateur
        $user = $token->getUser();

        // Si l'utilisateur courant est anonyme, $user vaut « anon. »
        // Sinon, c'est une instance de notre entité User, on peut l'utiliser normalement
        $owner = $user->getUsername();

        $em = $this->getDoctrine()->getEntityManager();
        $projects = $em->getRepository('ProjectBundle:Project')
        ->findBy(
            array('owner' => $owner,
             ));
        return $this->render('ProjectBundle:Default:user_profile.html.twig',  array('owner' => $owner, 'projects' => $projects));
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
                'message' => $US, 'owner' => $owner, 'project' => $project
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

public function help_backlogAction($owner, $project)
{

 
return $this->container->get('templating')->renderResponse('ProjectBundle:Default:help_backlog.html.twig',array(
   'owner' => $owner, 'project' => $project));
}

public function Add_TaskAction($owner, $project, $sprint){
    $up ='';
    $message = '';
    $Task = new Task();
    $em = $this->container->get('doctrine')->getEntityManager();
    

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
           $em->persist($Task);
           $em->flush();
           $message='Tache ajouté avec succès !';
       }
       
       
   }
   
   

   return $this->container->get('templating')->renderResponse('ProjectBundle:Sprint:Add_Task.html.twig',array(
    'form' => $form->createView(), 'message' => $message,'up' => $up, 'owner' => $owner, 'project' => $project, 'sprint' => $sprint));
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

public function Add_projectAction($owner){

    $up ='';
    $message = '';
    $Project = new Project(); 

    $form = $this->createFormBuilder($Project)
    ->add('id','text')
    ->add('name','text')
    ->add('description','text')
    ->getForm();

    $Project -> setOwner($owner); 
    $request = $this->container->get('request');

    if ($request->getMethod() == 'POST') 
    {
        $form->bind($request);
        if ($form->isValid()) 
        {

           $em = $this->container->get('doctrine')->getEntityManager();
           $em->persist($Project);
           $em->flush();
           $message='Project succesfully added';
       }
   }
   return $this->container->get('templating')->renderResponse('ProjectBundle:Default:Add_project.html.twig',array(
    'form' => $form->createView(), 'message' => $message, 'owner' => $owner, 'up' => ''));
}
}
