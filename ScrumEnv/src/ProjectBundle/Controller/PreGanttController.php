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

class PreGanttController extends Controller
{
    public function drawAction($owner, $project, $sprint)
    {
        $em = $this->getDoctrine()->getManager();
        $taskList = $em->getRepository('ProjectBundle:GanttTasks')
            ->findBy(
                array(
                    'sprint' => $sprint),
                array('id' => 'ASC')
             );
        $ganttData = array(
            'data' => array(), 
            'links' => array(), 
            'totalTasksCount' => 0 );
             
        foreach ($taskList as $task) {
                                 $t = array (
                                "id" => $task->getId(),
                                "text" => $task->gettext(),
                                //"parent" => "s".$step->getId(),
                                "start_date" => $task->getStartDate()->format("d-m-Y"),
                                "type" => "task",
                                "end_date" => $task->getStartDate()->format("d-m-Y")+$task->getDuration() ,
                                "progress" => $task->getProgress()/100,
                                );
                               $ganttData['data'][] = $t;
                           }
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $jsonTaskList = $serializer->serialize($taskList, 'json');
        
        return $this->render('ProjectBundle:Gantt:PreGanttCreate.html.twig', 
            array('owner' => $owner, 'project' => $project, 'sprint' => $sprint, 'taskList' => $taskList, 
            'jsonTaskList' => $jsonTaskList,'ganttData' => $ganttData));
    }
/////////////////////////////////:::::
 /*   public function getDataAction($boardId) {
        
        $em = $this->getDoctrine()->getManager();
        $board = $this->findOr404($em, 'PiloteTaskerBundle', 'Board', $boardId);
        $currentTasks = $this->getRequest()->query->get('currentTasks');
        $uuid = $this->getRequest()->query->get('uuid');
        $scale = $this->getRequest()->query->get('scale');

         /* Structure avec deux tableaux 
        $ganttData = array(
            'data' => array(), 
            'links' => array(), 
            'totalTasksCount' => 0 );

        $ganttData = $this->getDataForBoard($board, $ganttData, $currentTasks, $uuid);
        
        return $this->render('PiloteTaskerBundle:GanttCalendar:gantt.html.twig', array(
            'board' => $board,
            'ganttData' => json_encode($ganttData),
            'currentTasks' => $currentTasks,
            'uuid' => $uuid,
            'scale' => $scale,
            'totalTasksCount' => $ganttData['totalTasksCount']
        ));
    }
     */
    
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

    public function showTasksAction($sprint){
        
         $em = $this->getDoctrine()->getManager();
        $sprint = $em->getRepository('ProjectBundle:Sprint')
            ->findOneBy(
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
            array('sprint' => $sprintId, 'taskList' => $taskList, 'project' => $project, 'owner' =>$owner, 'kanban_view' => $kanban_view));
    

    }
    
    public function editGAnttAction($owner, $project, $sprint)
    {
        
    }
}
