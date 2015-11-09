<?php
namespace ProjectBundle\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProjectBundle\Entity\Sprint;
use ProjectBundle\Entity\Project;
use ProjectBundle\Form\SprintForm;

class SprintController extends Controller
{    
    public function SprintCreationAction($owner, $project, Request $request)
    {
        $sprint = new Sprint();
        $sprint->setOwner($owner);
        $sprint->setProject($project);
        $sprint->setID('0');
        $sprint->setDescription('sprint description');
        $sprint->setDateBegining(new \DateTime('Now'));
        $sprint->setDateEnd(new \DateTime('+1 week'));
        
        $form = $this->createFormBuilder($sprint)            
            ->add('description')
            ->add('id')
            ->add('dateBegining')
            ->add('dateEnd')
            ->getForm();
            
        $form->submit($request);
        
        if ($form->isValid()) 
        {            
            $sprint = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($sprint);
            $em->flush();
            return $this->redirectToRoute('Project', array('owner' => $owner, 'project' => $project));
        }        
        
        return $this->render('ProjectBundle:Sprint:SprintCreation.html.twig', 
            array('owner' => $owner, 'project' => $project, 'form' => $form->createView()));
    }
    public function SprintListAction($owner, $project, $sprintId)
    {
        $em = $this->getDoctrine()->getManager();
        $sprint = $em->getRepository('ProjectBundle:Sprint')
            ->findBy(
                array('owner' => $owner,
                    'project' => $project,
                    'id' => $sprintId));

        $taskList = $em->getRepository('ProjectBundle:Task')
            ->findBy(
                array('owner' => $owner,
                    'project' => $project,
                    'sprint' => $sprintId)
             );
        return $this->render('ProjectBundle:Sprint:Sprint.html.twig',
            array('sprint' => $sprint, 'taskList' => $taskList, 'project' => $project, 'owner' =>$owner));
    }
    public function SprintListDeleteTaskAction($owner, $project, $sprintId, $taskId){
        
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('ProjectBundle:Task')
            ->findOneBy(
                array('owner' => $owner,
                    'project' => $project,
                    'sprint' => $sprintId,
                    'id' => $taskId));
        if (!$task) 
        {
           throw new NotFoundHttpException("task not found");
        }
        $em->remove($task);
        $em->flush();
        return new RedirectResponse($this->container->get('router')->generate('Sprint_task_list', 
            array('owner' => $owner, 'project' => $project, 'sprintId' => $sprintId)));
    }
}
