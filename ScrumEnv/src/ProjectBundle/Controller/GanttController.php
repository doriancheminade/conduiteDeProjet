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
    public function editGAnttTaskAction($task)
    {
        $taskform = array();
        $form = $this->createFormBuilder($taskform)
            ->add('developer', 'text')
            ->add('dateBegining', 'datetime')
            ->add('dateEnd', 'datetime')
            ->add('id', 'hidden', array(
                'data' => $task->getId()))
            ->add('owner', 'hidden', array(
                'data' => $task->getOwner()))
            ->add('project', 'hidden', array(
                'data' => $task->getProject()))
            ->add('change', 'submit')
            ->getForm();    
        $request = $this->container->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $data = $request->request->get('form');
            $em = $this->getDoctrine()->getManager();
            $uptask = $em->getRepository('ProjectBundle:Task')->findOneBy(
                array('id' => $data['id'],
                    'owner' => $data['owner'],
                    'project' => $data['project']));
            $d1 = new \DateTime(
            $data['dateBegining']['date']['year']."-".$data['dateBegining']['date']['month']."-".$data['dateBegining']['date']['day'].
            " ".
            $data['dateBegining']['time']['hour'].":".$data['dateBegining']['time']['minute']);
            $d2 = new \DateTime(
            $data['dateEnd']['date']['year']."-".$data['dateEnd']['date']['month']."-".$data['dateEnd']['date']['day'].
            " ".
            $data['dateEnd']['time']['hour'].":".$data['dateEnd']['time']['minute']);
            $uptask->setDateBeginingReal($d1);
            $uptask->setDateEndReal($d2);
            $uptask->setDeveloper($data['developer']);
            var_dump($uptask);
            $em->persist($uptask);
            $em->flush();
        }
        return $this->container->get('templating')->renderResponse('ProjectBundle:Gantt:GanttEditTask.html.twig',
            array('form' => $form->createView(), 'task' => $task));
    }
    
    public function editGAnttAction($owner, $project, $sprint)
    {
        $em = $this->getDoctrine()->getManager();
        
        $request = $this->container->get('request');
        if($request->getMethod() == 'POST')
        {
            $this->forward('ProjectBundle:Gantt:editGanttTask',array('task' => new Task()));
        }
        
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
