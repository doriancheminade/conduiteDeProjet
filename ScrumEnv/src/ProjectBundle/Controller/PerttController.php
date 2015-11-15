<?php
namespace ProjectBundle\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProjectBundle\Form\SprintForm;

class PerttController extends Controller
{    
    public function generate_perttAction($owner, $project, $sprint)
    {

        $em = $this->getDoctrine()->getManager();
        $Tasks_sprint = $em->getRepository('ProjectBundle:Task')
            ->findBy(
                array('sprint' => $sprint,
                      'owner' => $owner,
                      'project' => $project
                    ));    

        return $this->container->get('templating')->renderResponse('ProjectBundle:Sprint:perttGeneration.html.twig',array('owner' => $owner, 'project' => $project, 'sprint' => $sprint, 'tasks' => $Tasks_sprint));
    }


}
