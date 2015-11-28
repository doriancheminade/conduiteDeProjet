<?php
namespace ProjectBundle\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProjectBundle\Entity\Task;
use ProjectBundle\Entity\Sprint;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class GanttController extends Controller
{
    public function drawAction($sprint,$taskList)
    {
    }
    
    public function newGanttAction()
    {
    }
    
    public function editGAnttTaskAction($task)
    {
        $taskform = array();
        $form = $this->createFormBuilder($taskform)
            ->add('developer', 'text')
            ->add('dateBegining', 'date')
            ->add('dateEnd', 'date')
            ->add('change', 'submit')
            ->getForm();
            
        $request = $this->container->get('request');
        $form->handleRequest($request);
        if ($form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $uptask = $em->getRepository('AppBundle:Task')->findOneBy();
            if (!$uptask) 
            {
                throw $this->createNotFoundException('No task found for id '.$task.getId());
            }
            $data = $form->getData();
            $product->setDateBegining(data.dateBegining);
            $product->setDateEnd(data.dateEnd);
            $em->flush();
        }
        return $this->container->get('templating')->renderResponse('ProjectBundle:Gantt:GanttEditTask.html.twig',
            array('form' => $form->createView(), 'task' => $task));
    }
    
    public function editGAnttAction($owner, $project, $sprint)
    {
        $em = $this->getDoctrine()->getManager();
        $taskList = $em->getRepository('ProjectBundle:Task')
            ->findBy(
                array('owner' => $owner,
                    'project' => $project,
                    'sprint' => $sprint),
                array('id' => 'ASC')
             );
             
        
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $jsonTaskList = $serializer->serialize($taskList, 'json');
        
        return $this->render('ProjectBundle:Gantt:GanttEdit.html.twig', 
            array('owner' => $owner, 'project' => $project, 'sprint' => $sprint, 'taskList' => $taskList, 
            'jsonTaskList' => $jsonTaskList));
    }
}
