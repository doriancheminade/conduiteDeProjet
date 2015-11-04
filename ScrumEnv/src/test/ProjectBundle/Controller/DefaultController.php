<?php
namespace test\ProjectBundle\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use test\ProjectBundle\Entity\UserStory;
use test\ProjectBundle\Form\UserStoryForm;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('testProjectBundle:Default:index.html.twig', array('name' => $name));
    }

    public function naviguerAction(){

    	$message = "hey";
    	return $this->render('testProjectBundle:Default:backlog.html.twig', array('message' => $message ));
    }

    public function listAction(){
    	$em = $this->container->get('doctrine')->getEntityManager();

        $US= $em->getRepository('testProjectBundle:UserStory')->findAll();

        return $this->container->get('templating')->renderResponse('testProjectBundle:Default:backlog.html.twig', 
        array(
        'message' => $US
        ));
        
    }

    public function Add_UsAction(){
        $up ='';
        $message = '';
        $User_Story = new UserStory();
       
        $form = $this -> createFormBuilder($User_Story)
            ->add('describe_UserStory','text')
            ->add('priority_UserStory','text')
            ->add('difficulty_UserStory','text')
            ->add('achievement_US','text')
         ->getForm();


         $request = $this->container->get('request');

          if ($request->getMethod() == 'POST') 
          {
            $form->bind($request);

            if ($form->isValid()) 
            {
               $em = $this->container->get('doctrine')->getEntityManager();
               $em->persist($User_Story);
               $em->flush();
               $message='User Story ajouté avec succès !';
           }
        }

        return $this->container->get('templating')->renderResponse('testProjectBundle:Default:Add_Us.html.twig',array(
        'form' => $form->createView(), 'message' => $message,'up' => $up));
    }

    public function Delete_UsAction($id){
        $em = $this->container->get('doctrine')->getEntityManager();
        $User_Story = $em->find('testProjectBundle:UserStory', $id);
            
        if (!$User_Story) 
        {
           throw new NotFoundHttpException("User_Story non trouvé");
        }
            
        $em->remove($User_Story);
        $em->flush();        


      return new RedirectResponse($this->container->get('router')->generate('go_to_backlog'));
    }

    public function Update_UsAction($id){

         $message = '';
         $up = 'ok';
         $em = $this->container->get('doctrine')->getEntityManager();
         $User_Story = $em->find('testProjectBundle:UserStory', $id);

         if (!$User_Story){
            $message = "Aucun acteur trouve";
         }

        $form = $this -> createFormBuilder($User_Story)
            ->add('describe_UserStory','text')
            ->add('priority_UserStory','text')
            ->add('difficulty_UserStory','text')
            ->add('achievement_US','text')
         ->getForm();

         $request = $this->container->get('request');

        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);

            if ($form->isValid()) 
            {
                $em->persist($User_Story);
                $em->flush();
                $message='Acteur modifié avec succès !';
            }
            else{
                $message = 'Form not valid';
            }
         }

          return $this->container->get('templating')->renderResponse('testProjectBundle:Default:Add_Us.html.twig',array(
        'form' => $form->createView(), 'message' => $message, 'up' => $up));
    }

    public function visualisationAction(){
        $em = $this->container->get('doctrine')->getEntityManager();

        $US= $em->getRepository('testProjectBundle:UserStory')->findAll();

        return $this->container->get('templating')->renderResponse('testProjectBundle:Kanban:Kanban_visualisation.html.twig', 
        array(
        'kanban_us' => $US,
        ));
    }

    public function Update_Us_achievementoGAction($id){

         $message = '';
         $up = 'ok';
         $em = $this->container->get('doctrine')->getEntityManager();
         $User_Story = $em->find('testProjectBundle:UserStory', $id);
          $US= $em->getRepository('testProjectBundle:UserStory')->findAll();
         if (!$User_Story){
            $message = "Aucune US trouve";
         }

         else{
            $User_Story -> setAchievementUS("onGoing");
            $em->persist($User_Story);
            $em->flush();
         }
          return $this->container->get('templating')->renderResponse('testProjectBundle:Kanban:Kanban_visualisation.html.twig',array('kanban_us' => $US, 'message' => $message, 'up' => $up));
    }

    public function Update_Us_achievementDAction($id){

         $message = '';
         $up = 'ok';
         $em = $this->container->get('doctrine')->getEntityManager();
         $User_Story = $em->find('testProjectBundle:UserStory', $id);
          $US= $em->getRepository('testProjectBundle:UserStory')->findAll();
         if (!$User_Story){
            $message = "Aucune US trouve";
         }

         else{
            $User_Story -> setAchievementUS("Done");
            $em->persist($User_Story);
            $em->flush();
         }
          return $this->container->get('templating')->renderResponse('testProjectBundle:Kanban:Kanban_visualisation.html.twig',array('kanban_us' => $US, 'message' => $message, 'up' => $up));
    }

    public function Update_Us_achievementToDoAction($id){

         $message = '';
         $up = 'ok';
         $em = $this->container->get('doctrine')->getEntityManager();
         $User_Story = $em->find('testProjectBundle:UserStory', $id);
          $US= $em->getRepository('testProjectBundle:UserStory')->findAll();
         if (!$User_Story){
            $message = "Aucune US trouve";
         }

         else{
            $User_Story -> setAchievementUS("ToDo");
            $em->persist($User_Story);
            $em->flush();
         }
          return $this->container->get('templating')->renderResponse('testProjectBundle:Kanban:Kanban_visualisation.html.twig',array('kanban_us' => $US, 'message' => $message, 'up' => $up));
    }
}